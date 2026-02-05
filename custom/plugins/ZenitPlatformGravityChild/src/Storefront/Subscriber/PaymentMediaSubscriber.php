<?php declare(strict_types=1);

namespace ZenitPlatformGravityChild\Storefront\Subscriber;

use Shopware\Storefront\Page\Checkout\Cart\CheckoutCartPageLoadedEvent;
use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\System\SalesChannel\Entity\SalesChannelRepository;


class PaymentMediaSubscriber implements EventSubscriberInterface
{
    private SalesChannelRepository $paymentMethodRepository;

    public function __construct(SalesChannelRepository $paymentMethodRepository)
    {
        $this->paymentMethodRepository = $paymentMethodRepository;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            CheckoutCartPageLoadedEvent::class => 'onCheckoutCartPageLoaded',
        ];
    }

    public function onCheckoutCartPageLoaded(CheckoutCartPageLoadedEvent $event): void
    {
        $paymentMethodCriteria = new Criteria();
        $paymentMethodCriteria->addAssociation('media');
        $similarProducts = $this->paymentMethodRepository->search($paymentMethodCriteria, $event->getSalesChannelContext());
        $event->getPage()->addArrayExtension('paymentMethod',[$similarProducts]);
        dd($event->getPage()->getExtension('paymentMethod'));
    }
}