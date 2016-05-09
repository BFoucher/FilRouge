Feature: Show homepage
  Test Behat

  Scenario: Access to homepage and I should see `Accueil` title
    Given I am on the homepage
    Then I should see 4 "h3" elements
    And I should see 1 "nav" elements
    And I should see "Dernières séries" in the "h3" element
    But I should not see "Exemple" in the "h3" element

  Scenario: Fill in registration form
    Given I am on "/serie"
    Then I should see 1 "h1" elements
    And I should see "Serie list" in the "h1" element

  Scenario: Test Login Route
    Given I am on "/login"
    And I fill in "username" with "Greg"
    And I fill in "password" with "a"
    And I press "_submit"
    Then I should be on "/login"
    And I should see "Identifiants invalides."

  Scenario: Test Login Route
    Given I am on "/login"
    And I fill in "username" with "user"
    And I fill in "password" with "test"
    And I press "_submit"
    Then I should be on homepage

  Scenario: User can't go to Admin Section
    Given I am logged in as User
    And I go to "/admin"
    Then the response status code should be 403
    And I should see "403 Forbidden"

  Scenario: Admin can go to Admin Section
    Given I am logged in as Administrator
    And I go to "/admin"
    Then I should see "Espace Admin"