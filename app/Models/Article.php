<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class Article extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'body', 'category_id', 'user_id', 'image'

    ];

    public static function uploadImage(Request $request)
    {
        if (!$request->hasFile('image')) {
            return;
        }
        $file = $request->file('image');
        $path =  $file->store('uploads', 'public');
        return $path;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'article_tag', 'article_id', 'tag_id', 'id', 'id');
    }

    public static function rules()
    {
        return [
            'title' => [
                'required',
                'string',
                'min:3',
                'max:255',
                // "unique:categories,name,$id",
                // Rule::unique('categories', 'name')->ignore($id),
                /*function($attribute, $value, $fails) {
                    if (strtolower($value) == 'laravel') {
                        $fails('This name is forbidden!');
                    }
                },*/
                // 'filter:php,laravel,html',
                //new Filter(['php', 'laravel', 'html']),
            ],
            'category_id' => [
                'nullable', 'int', 'exists:categories,id'
            ],
            'image' => [
                'image', 'max:1048576', 'dimensions:min_width=100,min_height=100',
            ],
            'body' => 'required|string|min:10',
            'tags' => ['required',
            function ($attribute, $value, $fail) {
                // Check each item in the "tags" array
                foreach (json_decode($value) as $item) {
                    if (!DB::table('tags')->where('name', $item->value)->exists()) {
                        $fail("The tag '$item->value' does not exist.");
                    }
                }
            },
        ],
        ];
    }
}
