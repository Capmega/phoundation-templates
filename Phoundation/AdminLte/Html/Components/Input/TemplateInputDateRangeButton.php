<?php

/**
 * Class TemplateInputDateRange
 *
 *
 *
 * @author Sven Olaf Oostenbrink <so.oostenbrink@gmail.com>
 * @license http://opensource.org/licenses/GPL-2.0 GNU Public License, Version 2
 * @copyright Copyright (c) 2024 Sven Olaf Oostenbrink <so.oostenbrink@gmail.com>
 * @package Templates\AdminLte
 */

declare(strict_types=1);

namespace Templates\Phoundation\AdminLte\Html\Components\Input;

use Phoundation\Web\Html\Components\Input\InputDateRangeButton;

class TemplateInputDateRangeButton extends TemplateInput
{
    /**
     * InputText class constructor
     */
    public function __construct(InputDateRangeButton $component)
    {
        $component->addClasses('form-control');
        parent::__construct($component);
    }


    /**
     * Render and return the HTML for this object
     *
     * @return string|null
     */
    public function render(): ?string
    {
//        <div class="form-group">
//            <label>Date range button:</label>
//            <div class="input-group">
//                <button type="button" class="btn btn-default float-right" id="daterange-btn">
//                    <i class="far fa-calendar-alt"></i> Date range picker
//                    <i class="fas fa-caret-down"></i>
//                </button>
//            </div>
//        </div>

//        //Date range as a button
//        $('#daterange-btn').daterangepicker(
//          {
//            ranges   : {
//            'Today'       : [moment(), moment()],
//              'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
//              'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
//              'Last 30 Days': [moment().subtract(29, 'days'), moment()],
//              'This Month'  : [moment().startOf('month'), moment().endOf('month')],
//              'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
//            },
//            startDate: moment().subtract(29, 'days'),
//            endDate  : moment()
//          },
//          function (start, end) {
//              $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
//          }
//        );

//        <script src="../../plugins/daterangepicker/daterangepicker.js"></script>

        return parent::render();
    }
}