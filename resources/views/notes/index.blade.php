<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>NoteStack</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Inter', 'Segoe UI', Arial, sans-serif;
        }
        .note-card {
            transition: box-shadow 0.2s, transform 0.2s;
        }
        .note-card:hover {
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
            transform: translateY(-4px) scale(1.02);
        }
        .note-input {
            padding: 1rem 1.25rem;
            border-radius: 9999px;
            border: 2px solid #e5e7eb;
            background: #f4f4fa;
            font-size: 1.1rem;
            transition: border 0.18s, box-shadow 0.18s;
            outline: none;
            margin-bottom: 0;
        }
        .note-input:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 2px #6366f133;
            background: #fff;
        }
        .note-color {
            width: 3rem;
            height: 3rem;
            border: 2px solid #e5e7eb;
            border-radius: 9999px;
            background: #f4f4fa;
            transition: border 0.18s;
        }
        .note-color:focus {
            border-color: #6366f1;
        }
        .note-btn {
            padding: 0.75rem 2rem;
            border-radius: 9999px;
            font-weight: 600;
            font-size: 1.1rem;
            background: #6366f1;
            color: #fff;
            border: none;
            box-shadow: 0 2px 8px 0 rgba(99,102,241,0.08);
            transition: background 0.2s, box-shadow 0.2s, transform 0.15s;
            cursor: pointer;
        }
        .note-btn:hover, .note-btn:focus {
            background: #4f46e5;
            box-shadow: 0 4px 16px 0 rgba(99,102,241,0.12);
            transform: translateY(-2px) scale(1.03);
        }
        .note-form-group {
            display: flex;
            gap: 1.2rem;
            width: 100%;
        }
        .note-form-group > * {
            flex: 1 1 0;
        }
        .note-form-color {
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 0 0 auto;
        }
        @media (max-width: 640px) {
            .note-form-group {
                flex-direction: column;
                gap: 0.75rem;
            }
            .note-btn {
                width: 100%;
            }
        }
        /* Filtros modernos */
        .note-filter-group {
            margin: 40px 0 32px 0;
            display: flex;
            gap: 1.5rem;
            justify-content: center;
        }
        .note-filter-link {
            padding: 0.5rem 1.5rem;
            border-radius: 9999px;
            font-weight: 500;
            font-size: 1.1rem;
            color: #6366f1;
            background: #f4f4fa;
            border: 2px solid transparent;
            transition: all 0.18s;
            text-decoration: none;
        }
        .note-filter-link.active,
        .note-filter-link:hover {
            background: #6366f1;
            color: #fff;
            border-color: #6366f1;
            text-decoration: none;
            box-shadow: 0 2px 8px 0 rgba(99,102,241,0.10);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 via-white to-gray-100 min-h-screen p-8">

    <div class="max-w-5xl mx-auto space-y-12">
        <div class="text-center">
            <h1 class="text-5xl font-extrabold text-gray-900 mb-3 tracking-tight">🗂️ NoteStack</h1>
            <p class="text-gray-500 text-xl font-light">Suas anotações organizadas com elegância</p>
        </div>

        {{-- Formulário de nova nota --}}
        <form action="{{ route('notes.store') }}" method="POST" class="bg-white/80 shadow-lg rounded-2xl p-8 border border-gray-100">
            @csrf
            <div class="note-form-group mb-4">
                <input name="title" placeholder="Título da nota" class="note-input" autocomplete="off">
                <input name="content" placeholder="Conteúdo..." class="note-input" autocomplete="off">
                <div class="note-form-color">
                    <input type="color" name="color" class="note-color" title="Escolha a cor">
                </div>
                <button class="note-btn" type="submit">Adicionar</button>
            </div>
        </form>

        {{-- Filtros --}}
        <div class="note-filter-group">
            <a href="{{ route('notes.index') }}"
               class="note-filter-link {{ !request()->has('favorite') ? 'active' : '' }}">
                Todas
            </a>
            <a href="{{ route('notes.index', ['favorite' => 1]) }}"
               class="note-filter-link {{ request()->get('favorite') ? 'active' : '' }}">
                Favoritas ⭐
            </a>
        </div>

        {{-- Lista de notas --}}
        <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @forelse ($notes as $note)
                <div class="note-card bg-white/90 border border-gray-100 rounded-2xl shadow-lg p-6 relative flex flex-col min-h-[180px]" style="background-color: {{ $note->color }};">
                    <form action="{{ route('notes.toggleFavorite', $note) }}" method="POST" class="absolute top-3 right-3">
                        @csrf
                        @method('PATCH')
                        <button class="text-2xl hover:scale-125 transition" title="Favoritar">
                            {{ $note->favorite ? '⭐' : '☆' }}
                        </button>
                    </form>

                    <h2 class="text-2xl font-bold text-gray-900 mb-2 truncate">{{ $note->title }}</h2>
                    <p class="text-gray-700 flex-1 break-words">{{ $note->content }}</p>

                    <form action="{{ route('notes.destroy', $note) }}" method="POST" class="mt-6 text-right">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-500 hover:text-red-700 text-base font-medium transition">Excluir 🗑</button>
                    </form>
                </div>
            @empty
                <p class="text-center text-gray-400 col-span-full text-lg">Nenhuma nota ainda.</p>
            @endforelse
        </div>
    </div>

</body>
</html>
