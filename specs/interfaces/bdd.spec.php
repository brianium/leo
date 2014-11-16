<?php
use Peridot\Leo\Interfaces\Bdd;

describe('Bdd', function() {
    beforeEach(function() {
        $this->interface = new Bdd();
    });

    /**
     * Test scope's chainable properties
     */
    include __DIR__ . '/../shared/is-interface.php';

    context('when ->not is accessed', function() {
        it('should set the negated flag and return self', function() {
            $scope = $this->interface->not;
            assert($scope === $this->interface, "should return self");
            assert($scope->isNegated(), "scope should be negated");
        });
    });

    context('when a flag returns non object', function() {
        it('should return the scope', function() {
            $flag = $this->getProphet()->prophesize('Peridot\Leo\Flag\FlagInterface');
            $flag->getId()->willReturn('zoom');
            $flag->__invoke($this->interface)->willReturn(null);
            $this->interface->setFlag($flag->reveal());

            $scope = $this->interface->zoom;
            assert($scope === $this->interface, 'non object return from flag should return interface');
        });
    });
});
