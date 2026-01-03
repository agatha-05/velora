<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Set;
use Illuminate\Support\Str;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TagsInput;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;
    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
    protected static ?string $navigationLabel = 'Produk';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Dasar')
                    ->schema([
                        Select::make('category_id')
                            ->relationship('category', 'name')
                            ->required()
                            ->searchable()
                            ->preload(),

                        TextInput::make('name')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),

                        TextInput::make('slug')
                            ->required()
                            ->disabled()
                            ->dehydrated(),
                        
                        TextInput::make('price')
                            ->numeric()
                            ->prefix('IDR')
                            ->label('Harga Utama')
                            ->required(),
                    ])->columns(2),

                Section::make('Varian Produk (Warna & Ukuran)')
                    ->description('Setiap baris mewakili satu kombinasi Warna + Ukuran + Stok (Sama seperti Shopee)')
                    ->schema([
                        Repeater::make('variants')
                    ->relationship()
                    ->schema([
                        FileUpload::make('image')
                            ->label('Foto Warna')
                            ->image()
                            ->directory('products')
                            ->columnSpanFull(),

                        TextInput::make('color')
                            ->label('Nama Warna/Tipe')
                            ->placeholder('Misal: Hitam')
                            ->required(),

                        // Gunakan TagsInput agar bisa banyak ukuran
                        TagsInput::make('size')
                            ->label('Daftar Ukuran')
                            ->placeholder('Ketik ukuran lalu Enter')
                            ->required(),

                        TextInput::make('stock')
                            ->label('Stok Total Warna Ini')
                            ->numeric()
                            ->default(1)
                            ->required(),

                        TextInput::make('price')
                            ->label('Harga Khusus (Opsional)')
                            ->numeric()
                            ->prefix('IDR'),
                    ])
                    ->columns(2)
                    ->grid(2)
                    ->label('Daftar Varian Warna')
                    ->collapsible()
                    // PERBAIKAN DI SINI: Kita gabungkan array ukuran menjadi teks agar tidak error
                    ->itemLabel(function (array $state): ?string {
                        $color = $state['color'] ?? 'Tanpa Warna';
                        $sizes = is_array($state['size'] ?? null) 
                            ? implode(', ', $state['size']) 
                            : ($state['size'] ?? 'Tanpa Ukuran');
                        
                        return "Warna: {$color} | Ukuran: {$sizes}";
                    }),
                    ])->columns(1),

                Section::make('Deskripsi & Status')
                    ->schema([
                        RichEditor::make('description')->columnSpanFull(),
                        Toggle::make('is_visible')->label('Tampilkan di Toko')->default(true),
                        Toggle::make('is_featured')->label('Produk Unggulan'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('variants.image')
                    ->label('Foto')
                    ->limit(1)
                    ->circular(),
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('price')->money('IDR'),
                TextColumn::make('variants_count')->counts('variants')->label('Total Varian')->badge(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}