<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700&display=swap" rel="stylesheet">
<script>
  tailwind.config = { theme: { extend: {
    fontFamily: { sans: ['"DM Sans"', 'sans-serif'], display: ['Fraunces', 'serif'] },
    colors: {
      cream: '#f6f1e6', sand: '#e9e1cc',
      forest: { 950: '#0b1f17', 900: '#0f2a20', 800: '#143828', 700: '#1b4d37', 600: '#23684a' },
      lime: { DEFAULT: '#c9f26b', dark: '#a8d64a' },
      clay: '#e8a54b'
    } } } }
</script>
<style>
  body { font-family: 'DM Sans', sans-serif; background: #f6f1e6; }
  .dots { background-image: radial-gradient(rgba(255,255,255,.12) 1px, transparent 1px); background-size: 18px 18px; }
  .no-scrollbar::-webkit-scrollbar { display: none; }
</style>
