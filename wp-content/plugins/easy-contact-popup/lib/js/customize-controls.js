/**
 * Helper showHide()
 */
function showHide( setting, ExpectedValues  ) {

    return function( control ) {

        var isDisplayed = function() {
            return $.inArray( setting.get(), ExpectedValues ) !== -1;
        };

        var setActiveState = function() {
            control.active.set( isDisplayed() );
        };

        control.active.validate = isDisplayed;
        setActiveState();
        setting.bind( setActiveState );
    };
}


wp.customize( 'ecp-options[popup-select-form-type]', function( setting ) {
	wp.customize.control('ecp-options[popup-select-cf7]', showHide( setting, ['cf7']) );
	wp.customize.control('ecp-options[popup-select-wpforms]', showHide( setting, ['wpforms']) );
	wp.customize.control('ecp-options[popup-select-gravityforms]', showHide( setting, ['gforms']) );
	wp.customize.control('ecp-options[popup-select-ninjaforms]', showHide( setting, ['ninjaforms']) );
	wp.customize.control('ecp-options[popup-select-weforms]', showHide( setting, ['weforms']) );
} );
