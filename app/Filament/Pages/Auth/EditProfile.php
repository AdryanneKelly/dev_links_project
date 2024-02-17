<?php

namespace App\Filament\Pages\Auth;

use Filament\Forms\Components\ColorPicker;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Pages\Auth\EditProfile as BaseEditProfile;
use Illuminate\Support\Facades\Hash;

class EditProfile extends BaseEditProfile
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('avatar')->label('Escolha a foto do seu avatar')
                    ->required()
                    ->imageEditor()
                    ->avatar()
                    ->inlineLabel(false)
                    ->columnSpanFull()
                    ->alignCenter()
                    ->label('Escolha seu avatar')
                    ->image()
                    ->directory('avatars' . '/' . auth()->id())
                    ->disk('public')
                    ->columnSpanFull(),
                TextInput::make('nickname')
                    ->required()
                    ->helperText('Esse nick será usado para montar o link do seu perfil e não deve conter espaços ou acentos. Ex: joao_silva')
                    ->validationMessages([
                        'unique' => 'Este nickname já está em uso.',
                    ])->afterStateUpdated(function ($state, Set $set) {
                        $set('profile_link', url('/') . '/dev/' . $state);
                    })->reactive()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                $this->getNameFormComponent()
                    ->label('Seu nome')
                    ->required()
                    ->maxLength(255),
                $this->getEmailFormComponent(),
                $this->getPasswordFormComponent()
                    ->label('Sua senha')
                    ->password()
                    ->dehydrateStateUsing(fn($state) => Hash::make($state))
                    ->dehydrated(fn($state) => filled($state))
                    ->required(fn(string $context): bool => $context === 'create')
                    ->disabled(fn(): bool => auth()->id() != request()->route('record')),
                $this->getPasswordConfirmationFormComponent(),
                ColorPicker::make('primary_color')
                    ->label('Cor principal')
                    ->required(),
                ColorPicker::make('secondary_color')
                    ->label('Cor secundária')
                    ->required(),
                TextInput::make('profile_link')->label('Link para seu perfil')->readOnly()->columnSpanFull()->inlineLabel(false),
                Textarea::make('bio')
                    ->label('Sua bio')
                    ->inlineLabel(false)
                    ->required()
                    ->columnSpanFull(),
                Repeater::make('links')
                    ->inlineLabel(false)
                    ->columnSpanFull()
                    ->relationship()
                    ->schema([
                        TextInput::make('title')
                            ->label('Título')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('url')
                            ->required()
                            ->url()
                            ->maxLength(255),
                        FileUpload::make('icon')
                            ->alignCenter()
                            ->columnSpanFull()
                            ->inlineLabel(false)
                            ->label('Ícone')
                            ->hint('Escolha imagens sem fundos. Ex: .svg, .png')
                            ->required()
                            ->image()
                            ->directory('icons' . '/' . auth()->id())
                            ->disk('public')
                            ->avatar()
                            ->alignCenter(),
                    ])->grid(2),
            ])->columns(2);
    }
}