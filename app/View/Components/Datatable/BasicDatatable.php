<?php

namespace App\View\Components\Datatable;

use Illuminate\View\Component;

class basicdatatable extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $tableId;
    public $tableTitle;
    public $source;
    public $cols = [];
    public $visibleCols = [];
    public $rows = [];
    public function __construct($tableId, $dataTable)
    {
        $this->tableId = $tableId;
        $this->tableTitle = isset($dataTable['tableTitle'])?$dataTable['tableTitle']:'';
        $this->source = isset($dataTable['source'])?$dataTable['source']:'';
        $this->cols = isset($dataTable['cols'])?$dataTable['cols']:[];
        $this->visibleCols = isset($dataTable['visibleCols'])?$dataTable['visibleCols']:[];
    }
    static function new($model, $source){
        $data_table = get_class_vars(self::class);
        $data_table['source'] = url($source);
        $fields = [];
        if(is_string($model)){
            $fields = \Schema::getColumnListing($model);
        } elseif (is_object($model) && method_exists($model, 'getTable')){
            $fields = \Schema::getColumnListing($model->getTable());
        }

        if($fields){
            foreach($fields as $field){
                $data_table['cols'][$field] = '';
            }
        }
        return $data_table;
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.datatable.basicdatatable');
    }
}
