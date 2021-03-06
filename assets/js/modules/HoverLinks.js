import $ from 'jquery';

//========Interior page nav hover effects to swap button css from one to the other.==========
function HoverLinks() {
    jQuery(document).ready(function($) {
        // Button ONE hover function:
        $('#first').hover(function() {      // mouse enter   
            $('#first').css({
                'background-color': '#353535',
                'color': '#E1E4D9',
                'z-index': '2'
            }),
            
            $('#second').css({
                'background-color': '#539B00',
                'color': '#353535' 
            });
        },
        function() {        // mouse leave
            $('#first').css({
                'background-color': '#539B00',
                'color': '#353535',
                'z-index': 'initial'
            }),
            
            $('#second').css({
                'background-color': '#353535',
                'color': '#E1E4D9'
            });
        });

        // Button TWO hover function:
        $('#second').hover(function() {     // mouse enter    
            $('#second').css({
                'background-color': '#539B00',
                'color': '#353535'
            }),
            
            $('#first').css({
                'background-color': '#353535',
                'color': '#E1E4D9'
            });
        },
        function() {        // mouse leave 
            $('#second').css({
                'background-color': '#353535',
                'color': '#E1E4D9'
            }),

            $('#first').css({
                'background-color': '#539B00',
                'color': '#353535'
            });
        });
    });
}

export default HoverLinks;