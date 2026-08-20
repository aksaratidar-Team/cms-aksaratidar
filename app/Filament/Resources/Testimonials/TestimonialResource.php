<?php

namespace App\Filament\Resources\Testimonials;

use App\Filament\Resources\Testimonials\Pages\CreateTestimonial;
use App\Filament\Resources\Testimonials\Pages\EditTestimonial;
use App\Filament\Resources\Testimonials\Pages\ListTestimonials;
use App\Filament\Resources\Testimonials\Schemas\TestimonialForm;
use App\Filament\Resources\Testimonials\Tables\TestimonialsTable;
use App\Models\Testimonial;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Forms\Components;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Testimonials';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Components\TextInput::make('client_name')
                    ->label('Nama Klien')
                    ->required()
                    ->maxLength(255),

                Components\TextInput::make('client_company')
                    ->label('Perusahaan / Instansi (Opsional)')
                    ->maxLength(255),

                Components\FileUpload::make('client_photo')
                    ->label('Foto Klien (Opsional)')
                    ->image()
                    ->avatar() // UI khusus foto profil bulat di Filament
                    ->directory('testimonials-photos'),

                Components\Select::make('rating')
                    ->label('Rating (Bintang)')
                    ->options([
                        1 => '⭐ 1 Bintang (Sangat Buruk)',
                        2 => '⭐⭐ 2 Bintang (Buruk)',
                        3 => '⭐⭐⭐ 3 Bintang (Cukup)',
                        4 => '⭐⭐⭐⭐ 4 Bintang (Baik)',
                        5 => '⭐⭐⭐⭐⭐ 5 Bintang (Sangat Baik)',
                    ])
                    ->default(5)
                    ->required(),

                Components\RichEditor::make('content')
                    ->label('Isi Testimoni')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return TestimonialsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTestimonials::route('/'),
            'create' => CreateTestimonial::route('/create'),
            'edit' => EditTestimonial::route('/{record}/edit'),
        ];
    }
}
