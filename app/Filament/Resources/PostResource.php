<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use DateTime;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use function Laravel\Prompts\search;


class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
           ->schema([
            Section::make('Main Content')->schema([
                TextInput::make('title')
                ->live()
                ->placeholder('Enter title')
                ->required()
                ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),

              TextInput::make('slug')
                ->live()
                ->placeholder('Enter slug')
                ->required()->unique(),
                RichEditor::make('body')->fileAttachmentsDirectory('posts/images')->required()->columnSpanFull(),
            ])->columns(2),

            Section::make('Meta')->schema([
                FileUpload::make('image')->image()->directory('posts/thumbniles')->nullable(),
                DateTimePicker::make('published_at')->format('Y-m-d H:i:s')->nullable(),
                Checkbox::make('featured'),
                Select::make('user_id')->relationship('author', 'name')->searchable()->required(),
                Select::make('categories')->multiple()->relationship('categories', 'title')->searchable()->required(),
            ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image'),
                TextColumn::make('title')->sortable()->searchable(),
                TextColumn::make('slug')->sortable()->searchable(),
                TextColumn::make('published_at')->date('Y-m-d H:i:s')->sortable()->searchable(),
                TextColumn::make('featured')->sortable()->searchable(),
                TextColumn::make('author.name')->label('Author')->sortable()->searchable(),
                
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
