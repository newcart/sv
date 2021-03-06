<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class input extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $class;
    public $value;
    public $name;
    public $type;
    public $label;

    public function __construct($name, $label, $class='', $type='', $value='')
    {
        $this->class = $class;
        $this->value = $value;
        $this->name = $name;
        $this->type = $this->validated_type($type);
        $this->label = $label;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.input');
    }
    private function validated_type($type){
        $types = ['text','hidden','number','file','checkbox','radio','email','password','textarea','cities', 'towns', 'countries'];
        if(in_array($type, $types)){
            return $type;
        }
        return 'text';
    }
}
