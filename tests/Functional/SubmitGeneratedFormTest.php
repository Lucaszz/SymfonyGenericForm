<?php

namespace Lucaszz\SymfonyGenericForm\Tests\Functional;

use Lucaszz\SymfonyGenericForm\Tests\fixtures\ObjectWithoutMetadata;
use Lucaszz\SymfonyGenericForm\Tests\fixtures\ObjectWithPhpDocMetadataOnConstructorParams;
use Lucaszz\SymfonyGenericForm\Tests\fixtures\ObjectWithPhpDocMetadataOnProperties;
use Lucaszz\SymfonyGenericForm\Tests\fixtures\ObjectWithTypeHinting;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Form\FormInterface;

class SubmitGeneratedFormTest extends FunctionalTestCase
{
    /** @test */
    public function it_can_submit_form_generated_form_from_class_without_metadata()
    {
        $form = $this->generator->generate(ObjectWithoutMetadata::class);

        $form->submit($this->validFormData());

        $this->assertThatFormWasSubmittedWithSuccess($form);
        $this->assertEquals(
            new ObjectWithoutMetadata('1', 'test', '2015-01-01 01:01:01', 'b771a92d-57a3-4442-ad85-165000c07f12'),
            $form->getData()
        );
    }

    /** @test */
    public function it_can_submit_form_generated_form_from_class_with_type_hints()
    {
        $form = $this->generator->generate(ObjectWithTypeHinting::class);

        $form->submit($this->validFormData());

        $this->assertThatFormWasSubmittedWithSuccess($form);
        $this->assertFormDataEqualsAndHasExpectedTypes(
            new ObjectWithTypeHinting('1', 'test', new \DateTime('2015-01-01 01:01:01'), Uuid::fromString('b771a92d-57a3-4442-ad85-165000c07f12')),
            $form
        );
    }

    /** @test */
    public function it_can_submit_form_generated_form_from_class_with_phpdoc_annotations_on_properties()
    {
        $form = $this->generator->generate(ObjectWithPhpDocMetadataOnProperties::class);

        $form->submit($this->validFormData());

        $this->assertThatFormWasSubmittedWithSuccess($form);
        $this->assertFormDataEqualsAndHasExpectedTypes(
            new ObjectWithPhpDocMetadataOnProperties(1, 'test', new \DateTime('2015-01-01 01:01:01'), Uuid::fromString('b771a92d-57a3-4442-ad85-165000c07f12')),
            $form
        );
    }

    /** @test */
    public function it_can_submit_form_generated_form_from_class_with_phpdoc_annotations_on_constructor_parameters()
    {
        $form = $this->generator->generate(ObjectWithPhpDocMetadataOnConstructorParams::class);

        $form->submit($this->validFormData());

        $this->assertThatFormWasSubmittedWithSuccess($form);
        $this->assertFormDataEqualsAndHasExpectedTypes(
            new ObjectWithPhpDocMetadataOnConstructorParams(1, 'test', new \DateTime('2015-01-01 01:01:01'), Uuid::fromString('b771a92d-57a3-4442-ad85-165000c07f12')),
            $form
        );
    }

    private function assertThatFormWasSubmittedWithSuccess(FormInterface $form)
    {
        $this->assertTrue($form->isValid());
        $this->assertTrue($form->isSubmitted());
        $this->assertTrue($form->isSynchronized());
    }

    private function validFormData()
    {
        return [
            'propertyInteger'  => 1,
            'propertyString'   => 'test',
            'propertyDateTime' => '2015-01-01 01:01:01',
            'propertyUuid'     => 'b771a92d-57a3-4442-ad85-165000c07f12',
        ];
    }

    private function assertFormDataEqualsAndHasExpectedTypes($expected, FormInterface $form)
    {
        $formData = $form->getData();

        $this->assertEquals($expected->propertyInteger, $formData->propertyInteger);
        $this->assertEquals($expected->propertyString, $formData->propertyString);
        $this->assertDateTimeEquals($expected->propertyDateTime, $formData->propertyDateTime);
        $this->assertUuidEquals($expected->propertyUuid, $formData->propertyUuid);
    }
}
