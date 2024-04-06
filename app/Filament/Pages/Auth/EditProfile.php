<?php

namespace App\Filament\Pages\Auth;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
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
                Tabs::make('Configurações de perfil')
                    ->tabs([
                        Tab::make('Informações de perfil')
                            ->schema([
                                FileUpload::make('avatar')->label('Escolha a foto do seu avatar')
                                    ->required()
                                    ->imageEditor()
                                    ->avatar()
                                    ->inlineLabel(false)
                                    ->alignCenter()
                                    ->image()
                                    ->directory('avatars' . '/' . auth()->id())
                                    ->disk('public')
                                    ->columnSpanFull(),
                                TextInput::make('nickname')
                                    ->required()
                                    ->alphaDash()
                                    ->inlineLabel(false)
                                    ->helperText('Esse nick será usado para montar o link do seu perfil e não deve conter espaços, caracteres especiais ou acentos.')
                                    ->validationMessages([
                                        'unique' => 'Este nickname já está em uso.',
                                        'alpha_dash' => 'O nickname não pode conter espaços, caracteres especiais ou acentos.',
                                        'required' => 'O nickname é obrigatório.',
                                    ])->afterStateUpdated(function ($state, Set $set) {
                                        $set('profile_link', url('/') . '/dev/' . $state);
                                    })->reactive()
                                    ->unique(ignoreRecord: true)
                                    ->maxLength(255),
                                $this->getNameFormComponent()
                                    ->label('Seu nome')
                                    ->required()
                                    ->inlineLabel(false)
                                    ->maxLength(255),
                                $this->getEmailFormComponent()->inlineLabel(false),
                                $this->getPasswordFormComponent()
                                    ->label('Sua senha')
                                    ->password()
                                    ->inlineLabel(false)
                                    ->dehydrated(fn($state) => filled($state))
                                    ->required(fn(string $context): bool => $context === 'create')
                                    ->disabled(fn(): bool => auth()->id() != request()->route('record')),
                                $this->getPasswordConfirmationFormComponent(),
                                TextInput::make('occupation')
                                    ->inlineLabel(false)
                                    ->label('Sua ocupação/profissão'),
                                TextInput::make('profile_link')->label('Link para seu perfil')->readOnly()->inlineLabel(false),
                                Textarea::make('bio')
                                    ->label('Sua bio')
                                    ->inlineLabel(false)
                                    ->required()
                                    ->columnSpanFull(),
                            ])->columns(2),
                        Tab::make('Configurações de cores')
                            ->schema([
                                ColorPicker::make('primary_color')
                                    ->label('Cor principal')
                                    ->required(),
                                ColorPicker::make('secondary_color')
                                    ->label('Cor secundária')
                                    ->required(),
                                ColorPicker::make('tertiary_color')
                                    ->label('Cor terciária')
                                    ->required(),
                                ColorPicker::make('text_color')
                                    ->label('Cor do texto')
                                    ->required(),
                                ColorPicker::make('border_color')
                                    ->label('Cor da borda')
                                    ->required(),
                                ColorPicker::make('menu_color')
                                    ->label('Cor de fundo dos links')
                                    ->rgba()
                                    ->required(),
                            ])->columns(2),
                        Tab::make('Seus links')
                            ->schema([
                                Fieldset::make('Links de botão')
                                    ->schema([
                                        Repeater::make('links')
                                            ->inlineLabel(false)
                                            ->relationship()
                                            ->columnSpanFull()
                                            ->schema([
                                                TextInput::make('title')
                                                    ->label('Título')
                                                    ->required()
                                                    ->maxLength(255),
                                                TextInput::make('url')
                                                    ->required()
                                                    ->url()
                                                    ->maxLength(255),
                                            ])->grid(2),
                                    ]),
                                Fieldset::make('Links de rodapé')
                                    ->schema([
                                        Repeater::make('bottomLinks')
                                            ->label('Links do rodapé')
                                            ->relationship()
                                            ->inlineLabel(false)
                                            ->columnSpanFull()
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
                                                    ->label('Ícone')
                                                    ->hint('Escolha imagens sem fundos. Ex: .svg, .png')
                                                    ->required()
                                                    ->image()
                                                    ->directory('icons' . '/' . auth()->id())
                                                    ->disk('public')
                                                    ->avatar()
                                                    ->alignCenter(),
                                            ])->grid(2),
                                    ]),
                            ])
                    ])->columnSpanFull(),
            ]);
    }
}