<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use BladeUI\Icons\Components\Icon;
use Filament\Forms;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
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

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
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
                    ->hint('Esse nome será exibido em sua página de links')
                    ->required()
                    ->maxLength(255),
                Select::make('user_type')->label('Tipo de usuário')
                    ->options([
                        'admin' => 'Admin',
                        'user' => 'User',
                    ]),
                TextInput::make('password')
                    ->label('Sua senha')
                    ->password()
                    ->dehydrateStateUsing(fn($state) => Hash::make($state))
                    ->dehydrated(fn($state) => filled($state))
                    ->required(fn(string $context): bool => $context === 'create')
                    ->disabled(fn(string $context): bool => auth()->id() != request()->route('record')),
                ColorPicker::make('primary_color')
                    ->label('Cor principal')
                    ->required(),
                ColorPicker::make('secondary_color')
                    ->label('Cor secundária')
                    ->required(),
                Textarea::make('bio')
                    ->label('Sua bio')
                    ->required()
                    ->columnSpanFull(),
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
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nickname')
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
