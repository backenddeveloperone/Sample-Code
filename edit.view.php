<?php


if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}

require_once("include/MVC/View/views/view.edit.php");

class ildar_external_brokers_commissionsViewEdit extends ViewEdit
{



    public function display(){



        $javascript = <<<'EOT'
        <script type="text/javascript">

        window.onload=function(){


        // Function will hide or reveal the "payment type" (arrangement) radio buttons
        function toggle_setup() {

            if (payment_type == 'amount' || payment_type == 'percentage') {

                // Get an then display parent div
                pNode = document.querySelector('div[data-label="LBL_ARRANGEMENT"]').parentNode;
                pNode.style.display='';

            } else {

                // Get an then hide parent div
                pNode = document.querySelector('div[data-label="LBL_ARRANGEMENT"]').parentNode;
                pNode.style.display='none';

            }

        }

        // Function will hide/show the 'payment amounts' either for percentage or fixed amount type of payments. It will look at the payment type (percent/fixed) and payment setup (single/split) and then hide/show the fields accordingly
        function toggle_payment_amounts() {

            // Type: percentage | Setup: single
            var percent_single = ["LBL_SINGLE_PERCENT_AMOUNT"];

            // Type: percentage | Setup: split
            var percent_split  = [ "LBL_PERCENT_ON_REST", "LBL_PERCENT_ON_INITIAL", "LBL_PERCENT_ON_INITIAL_AMOUNT" ] ;

            // Type: amount     | Setup: single
            var amount_single  = ["LBL_SINGLE_FIXED_AMOUNT" ];

            // Type: amount     | Setup: split
            var amount_split   = [ "LBL_AMOUNT_ON_REST", "LBL_AMOUNT_ON_INITIAL", "LBL_FIXED_ON_INITIAL_AMOUNT"];


            // If condition is right then show the elements otherwise hide it
            if(payment_type == 'percentage' && payment_setup == 'single') {
                show_parent(percent_single);
            } else {
                hide_parent(percent_single);
            }

            if(payment_type == 'percentage' && payment_setup == 'split') {
                show_parent(percent_split);
            } else {
                hide_parent(percent_split);
            }

            if(payment_type == 'amount' && payment_setup == 'single') {
                show_parent(amount_single);
            } else {
                hide_parent(amount_single);
            }

            if(payment_type == 'amount' && payment_setup == 'split') {
                show_parent(amount_split);
            } else {
                hide_parent(amount_split);
            }




        }

        // Will show the parent element
        function show_parent(l) {

            l.forEach(function(element) {

                pNode = document.querySelector('div[data-label="' + element + '"]').parentNode;
                pNode.style.display='';

            });


        }

        // Will hide the parent element
        function hide_parent(l) {

            l.forEach(function(element) {

                pNode = document.querySelector('div[data-label="' + element + '"]').parentNode;
                pNode.style.display='none';

            });


        }

        // Initial flags
        var payment_type  = null;  // Either fixed or percent
        var payment_setup = null;  // Either split or single

        // Get ALL radio button containers (each container will have multiple radio buttons inside of it)
        var radios = document.querySelectorAll('[type="radioenum"');

        // Go through all radio buttons (ones dealing with payment_type as well as those dealing with payment_setup)
        radios.forEach(function(element) {

            // What is the payment type? (get just type_c radio buttons and see if any are clicked and watch for any future clicks with .onclick)
            var payment_type_radios = element.querySelectorAll('[id="type_c"');

            payment_type_radios.forEach(function(element) {

                // If arrangement_c button is clicked
                element.onclick = function() {

                    payment_type = element.value;
                    // Show hide the type choices
                    toggle_setup();
                    toggle_payment_amounts();

                }

                // If it's checked
                if(element.checked) {

                    payment_type = element.value;
                    // Show/hide the type choices
                    toggle_setup();
                    toggle_payment_amounts();
                    //
                    // // DEBUG
                    // console.log('already checked and value of payment type is ' + payment_type);

                }

            });


            // What's the payment setup? (get arrangement_c radio buttons and see if any are clicked + watch for any future clicks with .onclick)
            var payment_setup_radios = element.querySelectorAll('[id="arrangement_c"');

            payment_setup_radios.forEach(function(element) {

                // If arrangement_c button is clicked
                element.onclick = function() {

                    payment_setup = element.value;
                    // Show hide the type choices
                    toggle_payment_amounts();


                    // DEBUG
                    console.log('clicked!');

                }

                // If it's checked
                if(element.checked) {

                    payment_setup = element.value;
                    // Show/hide the type choices
                    toggle_payment_amounts();

                    // DEBUG
                    console.log('already checked and value of payment setup is ' + payment_setup);

                }

            });

        });


        // Based on the info we gathered above proceed with hiding/showing of payment_setup windows (for selecting split/single) and with the hiding/showing of payment_amount fields (where we can enter for example 'Commission amount: 50000 on the initial 10000000')
        toggle_setup();
        toggle_payment_amounts();


        }

        </script>
EOT;

        echo $javascript;

        parent::display();

    }



}


