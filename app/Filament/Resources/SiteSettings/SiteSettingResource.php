<?php

namespace App\Filament\Resources\SiteSettings;

use App\Filament\Resources\SiteSettings\Pages\CreateSiteSetting;
use App\Filament\Resources\SiteSettings\Pages\EditSiteSetting;
use App\Filament\Resources\SiteSettings\Pages\ListSiteSettings;
use App\Filament\Resources\SiteSettings\Schemas\SiteSettingForm;
use App\Filament\Resources\SiteSettings\Tables\SiteSettingsTable;
use App\Models\SiteSetting;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;

class SiteSettingResource extends Resource
{
    protected static ?string $model = SiteSetting::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Site Setting';

    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                TextInput::make('company_name')
                    ->label('Nama Perusahaan')
                    ->required()
                    ->maxLength(255),

                FileUpload::make('company_logo')
                    ->label('Logo Perusahaan')
                    ->image()
                    ->directory('site-settings')
                    ->columnSpanFull(),

                TextInput::make('contact_email')
                    ->label('Email Kontak')
                    ->email()
                    ->maxLength(255),

                TextInput::make('contact_phone')
                    ->label('Nomor Telepon')
                    ->tel()
                    ->maxLength(255),

                Textarea::make('address')
                    ->label('Alamat Lengkap')
                    ->rows(3)
                    ->columnSpanFull(),

                Textarea::make('about_us_text')
                    ->label('Teks Tentang Kami (Singkat)')
                    ->rows(4)
                    ->columnSpanFull(),

                // Repeater untuk Social Media (bisa ditambah sebanyak-banyaknya)
                Repeater::make('social_media')
                    ->label('Tautan Media Sosial')
                    ->schema([
                        Select::make('platform')
                            ->label('Platform')
                            ->options([
                                'facebook' => 'Facebook',
                                'instagram' => 'Instagram',
                                'linkedin' => 'LinkedIn',
                                'twitter' => 'Twitter / X',
                                'youtube' => 'YouTube',
                                'tiktok' => 'TikTok',
                            ])
                            ->required(),
                        TextInput::make('url')
                            ->label('URL / Tautan')
                            ->url()
                            ->required(),
                    ])
                    ->columns(2)
                    ->columnSpanFull()
                    ->addActionLabel('Tambah Media Sosial'),
            ]);
    }

    public static function form(Schema $schema): Schema
    {
        return \App\Filament\Resources\SiteSettings\Schemas\SiteSettingForm::configure($schema);
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
            'index' => ListSiteSettings::route('/'),
            'create' => CreateSiteSetting::route('/create'),
            'edit' => EditSiteSetting::route('/{record}/edit'),
        ];
    }
}
