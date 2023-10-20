<?php
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class DuskTestPrueba extends DuskTestCase
{
    public function testWebClicks()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/example') // Replace with the URL or route of your Blade view
                ->click('@button-id') // Replace with the selector of the button you want to click
                ->waitForText('Expected Text in the View')
                ->screenshot('step1'); // Capture a screenshot of the page after the click
        });
    }
}

?>