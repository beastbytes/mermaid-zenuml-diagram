<?php
/**
 * @copyright Copyright © 2024 BeastBytes - All rights reserved
 * @license BSD 3-Clause
 */

declare(strict_types=1);

use BeastBytes\Mermaid\ZenumlDiagram\Alt;
use BeastBytes\Mermaid\ZenumlDiagram\Annotation;
use BeastBytes\Mermaid\ZenumlDiagram\AsyncMessage;
use BeastBytes\Mermaid\ZenumlDiagram\Block;
use BeastBytes\Mermaid\ZenumlDiagram\ConditionalBlock;
use BeastBytes\Mermaid\ZenumlDiagram\Participant;
use BeastBytes\Mermaid\ZenumlDiagram\ReturnMessage;
use BeastBytes\Mermaid\ZenumlDiagram\SyncMessage;
use BeastBytes\Mermaid\ZenumlDiagram\ZenumlDiagram;

// https://zenuml.com/docs/examples/sequence-diagram-online-shop
test('Online Shopping Diagram', function () {
    $backend = new Participant('BackEnd');
    $customer = new Participant('Customer', annotation: Annotation::Actor);
    $deliverySystem = new Participant('DeliverySystem');
    $paymentGateway = new Participant('PaymentGateway');
    $website = new Participant('Website');

    expect(
        (new ZenumlDiagram())
            ->withTitle('Online shopping')
            ->withParticipant($customer)
            ->withItem(
                (new SyncMessage('browse', $customer, $website))
                    ->withItem(new SyncMessage('loadProducts', $backend))
                ,
                (new SyncMessage('addToCart', $customer, $website))
                    ->withParameter('p1', 'p2')
                    ->withItem(new SyncMessage('updateCart', $backend))
                ,
                (new SyncMessage('submitOrder', $customer, $website))
                    ->withParameter('p1', 'p2')
                    ->withItem(new SyncMessage('createOrder', $backend))
                ,
                (new SyncMessage('checkout', $customer, $website))
                    ->withParameter('paymentInfo')
                    ->withItem(
                        (new SyncMessage('checkout', $backend))
                            ->withParameter('paymentInfo')
                            ->withItem(
                                (new SyncMessage('processPaymentInfo', $paymentGateway))
                                    ->withReturn('result')
                                ,
                                (new SyncMessage('updateOrder'))
                                    ->withParameter('result')
                                ,
                                (new Alt((new ConditionalBlock('result == success'))
                                    ->withItem(
                                        new SyncMessage('register', $deliverySystem),
                                        new AsyncMessage('Deliver the order', $deliverySystem, $customer)
                                    )
                                ))
                                ->withElse((new Block())
                                    ->withItem(
                                        new ReturnMessage('rejected'),
                                        new ReturnMessage(new AsyncMessage('rejected', $website, $customer))
                                    )
                                )
                            )
                    )
                ,
            )
            ->render()
    )
        ->toBe("<pre class=\"mermaid\">\n"
            . "zenuml\n"
            . "  title Online shopping\n"
            . "  @Actor Customer\n"
            . "  Customer -&gt; Website.browse() {\n"
            . "    BackEnd.loadProducts()\n"
            . "  }\n"
            . "  Customer -&gt; Website.addToCart(p1, p2) {\n"
            . "    BackEnd.updateCart()\n"
            . "  }\n"
            . "  Customer -&gt; Website.submitOrder(p1, p2) {\n"
            . "    BackEnd.createOrder()\n"
            . "  }\n"
            . "  Customer -&gt; Website.checkout(paymentInfo) {\n"
            . "    BackEnd.checkout(paymentInfo) {\n"
            . "      result = PaymentGateway.processPaymentInfo()\n"
            . "      updateOrder(result)\n"
            . "      if (result == success) {\n"
            . "        DeliverySystem.register()\n"
            . "        DeliverySystem -&gt; Customer: Deliver the order\n"
            . "      } else {\n"
            . "        return rejected\n"
            . "        @return Website -&gt; Customer: rejected\n"
            . "      }\n"
            . "    }\n"
            . "  }\n"
            . '</pre>'
        )
    ;
});
