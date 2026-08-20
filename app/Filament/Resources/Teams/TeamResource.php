<?php

namespace App\Filament\Resources\Teams;

use App\Filament\Resources\Teams\Pages\CreateTeam;
use App\Filament\Resources\Teams\Pages\EditTeam;
use App\Filament\Resources\Teams\Pages\ListTeams;
use App\Filament\Resources\Teams\Tables\TeamsTable;
use App\Models\Team;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

// 1. Menggunakan class Schema & Components standar Filament terbaru
use Filament\Schemas\Schema;
use Filament\Forms\Components;

class TeamResource extends Resource
{
    protected static ?string $model = Team::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static ?string $recordTitleAttribute = 'Teams';

    // 2. Parameter sekarang menggunakan Schema $schema
    public static function form(Schema $schema): Schema
    {
        return $schema
            // 3. Menggunakan method components() untuk membungkus form
            ->components([
                Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                Components\TextInput::make('role')
                    ->required()
                    ->maxLength(255),

                // Area Upload Gambar
                Components\FileUpload::make('photo')
                    ->image()
                    ->directory('teams-photos')
                    ->columnSpanFull(),

                Components\Textarea::make('bio')
                    ->columnSpanFull(),

                // Repeater untuk Social Media (bisa ditambah banyak)
                Components\Repeater::make('social_links')
                    ->schema([ // Komponen di dalam repeater tetap memakai schema()
                        Components\Select::make('platform')
                            ->label('Platform')
                            ->options([
                                'linkedin' => 'LinkedIn',
                                'github' => 'GitHub',
                                'instagram' => 'Instagram',
                                'twitter' => 'Twitter / X',
                                'facebook' => 'Facebook',
                                'website' => 'Personal Website',
                            ])
                            ->required(),
                        Components\TextInput::make('url')
                            ->label('Link / URL')
                            ->url()
                            ->required(),
                    ])
                    ->columns(2)
                    ->columnSpanFull()
                    ->addActionLabel('Tambah Sosial Media'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return TeamsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTeams::route('/'),
            'create' => CreateTeam::route('/create'),
            'edit' => EditTeam::route('/{record}/edit'),
        ];
    }
}