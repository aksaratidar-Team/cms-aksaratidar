<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use Filament\Forms\Set;


class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            // Membagi form menjadi 2 kolom utama sebagai pengganti Section agar aman
            ->columns(2)
            ->components([
                TextInput::make('title')
                    ->label('Nama Proyek')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn(callable $set, ?string $state) => $set('slug', Str::slug($state))),

                TextInput::make('slug')
                    ->label('URL Slug')
                    ->required()
                    ->readOnly()
                    ->unique(ignoreRecord: true),

                RichEditor::make('description')
                    ->label('Deskripsi Proyek')
                    ->required()
                    ->columnSpanFull(),

                Select::make('status')
                    ->label('Status Proyek')
                    ->options([
                        'On Going' => 'On Going (Sedang Berjalan)',
                        'Completed' => 'Completed (Selesai)',
                    ])
                    ->required()
                    ->default('On Going'),

                TagsInput::make('technologies')
                    ->label('Teknologi (Ketik & Tekan Enter)')
                    ->columnSpanFull(),

                DatePicker::make('start_date')
                    ->label('Tanggal Mulai')
                    ->required(),

                DatePicker::make('completion_date')
                    ->label('Tanggal Selesai (Opsional)'),

                FileUpload::make('cover_image')
                    ->label('Thumbnail Utama')
                    ->image()
                    ->directory('projects-cover')
                    ->required()
                    ->columnSpanFull(),

                FileUpload::make('gallery')
                    ->label('Galeri Tambahan')
                    ->multiple()
                    ->image()
                    ->reorderable()
                    ->directory('projects-gallery')
                    ->columnSpanFull(),

                TextInput::make('project_url')
                    ->label('Tautan Proyek (Opsional)')
                    ->url()
                    ->columnSpanFull(),
            ]);
    }
}