<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /** Ambil data beasiswa (opsional difilter) + ringkasan total. */
    private function summary(?int $programId = null): array
    {
        $all = DB::table('scholarships')->orderBy('id')->get();
        $rows = $programId ? $all->where('id', $programId)->values() : $all;

        $applicants = (int) $rows->sum('applicants');
        $admin      = (int) $rows->sum('passed_admin');
        $selection  = (int) $rows->sum('passed_selection');
        $recipients = (int) $rows->sum('recipients');
        $quota      = (int) $rows->sum('quota');

        $pct = fn ($a, $b) => $b > 0 ? round($a / $b * 100, 1) : 0;

        return [
            'programs'   => $all,
            'rows'       => $rows,
            'selected'   => $programId,
            'applicants' => $applicants,
            'admin'      => $admin,
            'selection'  => $selection,
            'recipients' => $recipients,
            'quota'      => $quota,
            'admin_pct'  => $pct($admin, $applicants),
            'accept_pct' => $pct($recipients, $applicants),
            'fill_pct'   => $pct($recipients, $quota),
            'pct'        => $pct,
        ];
    }

    public function overview(Request $request)
    {
        return view('dashboard.overview', $this->summary($request->integer('program') ?: null));
    }

    public function scholarships(Request $request)
    {
        return view('dashboard.scholarships', $this->summary());
    }

    public function funnel(Request $request)
    {
        return view('dashboard.funnel', $this->summary($request->integer('program') ?: null));
    }

    public function manage()
    {
        return view('dashboard.manage', ['programs' => DB::table('scholarships')->orderBy('id')->get()]);
    }

    public function assistant()
    {
        return view('dashboard.assistant', $this->summary());
    }

    // ---------- CRUD data beasiswa ----------
    private function rules(): array
    {
        return [
            'name'             => ['required', 'string', 'max:120'],
            'quota'            => ['required', 'integer', 'min:0'],
            'applicants'       => ['required', 'integer', 'min:0'],
            'passed_admin'     => ['required', 'integer', 'min:0', 'lte:applicants'],
            'passed_selection' => ['required', 'integer', 'min:0', 'lte:passed_admin'],
            'recipients'       => ['required', 'integer', 'min:0', 'lte:passed_selection'],
        ];
    }

    private function messages(): array
    {
        return [
            'passed_admin.lte'     => 'Lolos administrasi tidak boleh melebihi jumlah pendaftar.',
            'passed_selection.lte' => 'Lolos seleksi tidak boleh melebihi lolos administrasi.',
            'recipients.lte'       => 'Penerima tidak boleh melebihi lolos seleksi.',
        ];
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->rules(), $this->messages());
        DB::table('scholarships')->insert($data + ['created_at' => now(), 'updated_at' => now()]);
        return back()->with('success', 'Program beasiswa ditambahkan.');
    }

    public function update(Request $request, int $id)
    {
        $data = $request->validate($this->rules(), $this->messages());
        DB::table('scholarships')->where('id', $id)->update($data + ['updated_at' => now()]);
        return back()->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(int $id)
    {
        DB::table('scholarships')->where('id', $id)->delete();
        return back()->with('success', 'Program dihapus.');
    }

    // ---------- Export CSV ----------
    public function export(Request $request)
    {
        $s = $this->summary($request->integer('program') ?: null);

        return response()->streamDownload(function () use ($s) {
            $out = fopen('php://output', 'w');
            fputcsv($out, ['Program', 'Kuota', 'Pendaftar', 'Lolos Administrasi', 'Lolos Seleksi', 'Penerima']);
            foreach ($s['rows'] as $r) {
                fputcsv($out, [$r->name, $r->quota, $r->applicants, $r->passed_admin, $r->passed_selection, $r->recipients]);
            }
            fputcsv($out, ['TOTAL', $s['quota'], $s['applicants'], $s['admin'], $s['selection'], $s['recipients']]);
            fclose($out);
        }, 'lentera-report-' . now()->format('Ymd') . '.csv', ['Content-Type' => 'text/csv']);
    }
}
