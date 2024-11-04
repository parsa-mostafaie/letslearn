<?php

namespace App\Livewire\Forms;

use App\Models\Course;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Milwad\LaravelValidate\Rules\ValidSlug;

class CourseForm extends Form
{
    protected $model = null;

    public $title = '';
    public $description = '';
    public $slug = '';
    public $thumbnail;

    public function rules()
    {
        $unique = Rule::unique(Course::class);
        
        if ($this->model) {
            $unique->ignoreModel($this->model);
        }

        return [
            'title' => 'required|string|max:256',
            'description' => 'nullable|string|max:2048',
            'slug' => ['nullable', 'string', new ValidSlug, $unique],
            'thumbnail' => 'nullable|image|max:1024',
        ];
    }

    public function save($model = null)
    {
        $this->model = $model;

        $data = $this->validate();

        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);

        if ($data['thumbnail']) {
            $data['thumbnail'] = $data['thumbnail']->store('course-thumbnails');

            if ($this->model)
                $this->model->removePreviousImage();
        }

        /**
         * @var \App\Models\User
         */
        $user = Auth::user();

        if (!$this->model)
            $user->courses()->create($data);
        else
            $this->model->update($data);

        $this->reset();
    }
}
