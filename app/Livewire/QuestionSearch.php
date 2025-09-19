<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Question;

class QuestionSearch extends Component
{
    public $search = '';
    public $searchResults = [];

    public function updatedSearch()
    {
        $trimmedSearch = preg_replace('/\s+/', ' ', trim($this->search));
        
        if ($trimmedSearch !== '') {
            $this->searchResults = Question::query()
                ->where(function ($query) use ($trimmedSearch) {
                    $query->where('text', 'like', '%' . $trimmedSearch . '%');

                    if (ctype_digit($trimmedSearch)) {
                        $query->orWhere('id', (int) $trimmedSearch);
                    }

                    $query->orWhereHas('groups', function ($q) use ($trimmedSearch) {
                        $q->where('name', 'like', '%' . $trimmedSearch . '%')
                          ->orWhere('title', 'like', '%' . $trimmedSearch . '%');
                    });
                })
                ->with(['groups:id,name,title'])
                ->distinct()
                ->take(10)
                ->get();
        } else {
            $this->searchResults = [];
        }
    }


    public function highlightText($text, $search)
    {
        if (empty($search)) {
            return $text;
        }

        $searchTerm = preg_quote($search, '/');
        return preg_replace("/($searchTerm)/iu", '<span class="bg-red-500 text-white">$1</span>', $text);
    }

    public function render()
    {
        return view('livewire.question-search');
    }
}