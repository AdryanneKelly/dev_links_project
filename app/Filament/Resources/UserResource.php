<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use BladeUI\Icons\Components\Icon;
use Faker\Core\Color;
use Filament\Forms;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Infolists\Components\IconEntry;
use Filament\Resources\Resource;
use Filament\Support\Enums\Alignment;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $modelLabel = 'Usuários';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
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
                                    ->columnSpanFull()
                                    ->alignCenter()
                                    ->label('Escolha seu avatar')
                                    ->image()
                                    ->directory('avatars' . '/' . auth()->id())
                                    ->disk('public')
                                    ->columnSpanFull(),
                                TextInput::make('name')->label('Seu nome')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('email')->label('Seu email')
                                    ->email()
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('nickname')
                                    ->label('Seu nickname')
                                    ->alphaDash()
                                    ->helperText('Esse nick será usado para montar o link do seu perfil e não deve conter espaços ou acentos. Ex: joao_silva')
                                    ->validationMessages([
                                        'unique' => 'Este nickname já está em uso.',
                                        'alpha_dash' => 'O nickname não pode conter espaços, caracteres especiais ou acentos.',
                                        'required' => 'O nickname é obrigatório.',
                                    ])
                                    ->unique(ignoreRecord: true)
                                    ->required()
                                    ->afterStateUpdated(function (Get $get, $state, Set $set) {
                                        $set('profile_link', url('/') . '/dev/' . $state);
                                    })->reactive()
                                    ->maxLength(255),
                                TextInput::make('password')
                                    ->label('Sua senha')
                                    ->password()
                                    ->dehydrateStateUsing(fn($state) => Hash::make($state))
                                    ->dehydrated(fn($state) => filled($state))
                                    ->required(fn(string $context): bool => $context === 'create'),
                                Select::make('user_type')->label('Tipo de usuário')
                                    ->options([
                                        'admin' => 'Admin',
                                        'user' => 'User',
                                    ]),
                                TextInput::make('profile_link')
                                    ->label('Link para seu perfil')
                                    ->readOnly(),
                                TextInput::make('occupation')
                                    ->label('Sua ocupação/profissão'),
                                Textarea::make('bio')
                                    ->label('Sua bio')
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

                            ]),
                    ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nome')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nickname')
                    ->label('Nickname')
                    ->searchable(),
                ImageColumn::make('avatar')->circular(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
