<?php

namespace App\Filament\Pages\Auth;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Pages\Auth\Register;
use Filament\Pages\Page;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Illuminate\Support\Facades\Hash;

class RegisterProfile extends Register
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nickname')
                    ->label('Seu nickname')
                    ->required()
                    ->validationMessages([
                        'unique' => 'Este nickname já está em uso.',
                    ])
                    ->unique('users', 'nickname')
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

            ]);
    }
}
