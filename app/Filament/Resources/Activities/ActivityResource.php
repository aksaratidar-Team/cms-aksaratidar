<?php

namespace App\Filament\Resources\Activities;

use App\Filament\Resources\Activities\Pages\CreateActivity;
use App\Filament\Resources\Activities\Pages\EditActivity;
use App\Filament\Resources\Activities\Pages\ListActivities;
use App\Filament\Resources\Activities\Schemas\ActivityForm;
use App\Filament\Resources\Activities\Tables\ActivitiesTable;
use App\Models\Activity;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Forms\Components;



class ActivityResource extends Resource
{
    protected static ?string $model = Activity::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Activity';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Components\TextInput::make('title')
                    ->label('Nama Aktivitas')
                    ->required()
                    ->maxLength(255),

                Components\DatePicker::make('date')
                    ->label('Tanggal Pelaksanaan')
                    ->required(),

                Components\FileUpload::make('cover_image')
                    ->label('Foto Utama (Cover)')
                    ->image()
                    ->directory('activities-cover')
                    ->columnSpanFull(),

                Components\RichEditor::make('description')
                    ->label('Penjelasan Aktivitas')
                    ->required()
                    ->columnSpanFull(),

                // Keajaiban Multiple Upload Filament
                Components\FileUpload::make('gallery')
                    ->label('Dokumentasi Galeri (Bisa pilih banyak foto)')
                    ->multiple() // Fitur kunci untuk input array/JSON
                    ->image()
                    ->reorderable() // Bisa geser-geser urutan foto
                    ->directory('activities-gallery')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return ActivitiesTable::configure($table);
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
            'index' => ListActivities::route('/'),
            'create' => CreateActivity::route('/create'),
            'edit' => EditActivity::route('/{record}/edit'),
        ];
    }
}
