<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends MinkContext implements Context, SnippetAcceptingContext
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @Given /^(?:|I )am logged in as Administrator$/
     */
    public function iAmLoggedInAsAdministrator()
    {
        $this->visit('/login');
        $this->fillField('username', 'admin');
        $this->fillField('password', 'test');
        $this->pressButton('_submit');
    }

    /**
     * @Given /^(?:|I )am logged in as User/
     */
    public function iAmLoggedInAsUser()
    {
        $this->visit('/login');
        $this->fillField('username', 'user');
        $this->fillField('password', 'test');
        $this->pressButton('_submit');
    }
}
