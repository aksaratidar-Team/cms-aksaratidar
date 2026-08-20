<?php

namespace App\Filament\Resources\SiteSettings\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class SiteSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('company_name')
                    ->required(),
                TextInput::make('company_logo'),
                TextInput::make('contact_email')
                    ->email(),
                TextInput::make('contact_phone')
                    ->tel(),
                Textarea::make('address')
                    ->columnSpanFull(),
                Textarea::make('social_media')
                    ->columnSpanFull(),
                Textarea::make('about_us_text')
                    ->columnSpanFull(),
            ]);
    }
}
