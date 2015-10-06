<?php namespace inkvizytor\FluentForm\Controls;

use inkvizytor\FluentForm\Base\Fluent;
use inkvizytor\FluentForm\Base\Handler;
use inkvizytor\FluentForm\Model\Binder;
use inkvizytor\FluentForm\Renderers\Base;

/**
 * Class Checkable
 *
 * @package inkvizytor\FluentForm\Controls
 */
class Checkable extends Fluent
{
    /** @var array */
    protected $guarded = ['type', 'value', 'checked', 'placeholder', 'always'];

    /** @var string */
    private $type = 'checkbox';
    
    /** @var int|mixed */
    protected $value;

    /** @var bool */
    protected $checked;

    /** @var bool */
    protected $always = false;

    /**
     * @param \inkvizytor\FluentForm\Base\Handler $handler
     * @param string $type
     */
    public function __construct(Handler $handler, $type = 'checkbox')
    {
        parent::__construct($handler);

        $this->type = $type;
    }
    
    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param int|mixed $value
     * @return $this
     */
    public function value($value)
    {
        $this->value = $value;

        return $this;
    }
    
    /**
     * @param bool $checked
     * @return $this
     */
    public function checked($checked)
    {
        $this->checked = $checked;

        return $this;
    }

    /**
     * @param bool $always
     * @return $this
     */
    public function always($always)
    {
        $this->always = $always;

        return $this;
    }

    /**
     * @return string
     */
    public function render()
    {
        $content = null;
        $options = $this->getOptions();
        $attributes = array_only($options, 'class');
        
        if ($this->getType() == 'checkbox')
        {
            $content  = $this->always ? $this->form()->hidden($this->name, false) : '';
            $content .= $this->form()->checkbox($this->name, $this->value, $this->checked, array_except($options, 'class'));
        }
        else
        {
            $content = $this->form()->radio($this->name, $this->value, $this->checked, array_except($options, 'class'));
        }
        
        return '<label'.$this->html()->attributes($attributes).'>'.$content.' '.$this->getLabel().'</label>';
    }
} 