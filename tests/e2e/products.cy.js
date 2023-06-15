const PRODUCT_NAME = 'Path of Exile';

describe('Products', () => {

    it('Shows a product page', () => {
        cy.visit('/');
        cy.contains(PRODUCT_NAME).click();
        cy.contains('Price: $0.00').should('exist');
    })

    it('Edits a product', () => {
        cy.visit('/');
        cy.contains(PRODUCT_NAME).click();
        cy.contains('Admin Edit').click();

        cy.get('input[name="price"]').clear().type('0.00');
        cy.get('input[type="submit"]').click();
    })
})
