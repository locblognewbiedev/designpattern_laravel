<?php

#Các Lớp và Interface Cần Thiết
# Abstract Products (Interface)

interface Button
{
    public function paint();
}

interface Checkbox
{
    public function paint();
}

#Các lớp cụ thể
class WinButton implements Button
{
    public function paint()
    {
        echo "Rendering a button in Windows style\n";
    }
}

class WinCheckbox implements Checkbox
{
    public function paint()
    {
        echo "Rendering a checkbox in Windows style\n";
    }
}

class MacButton implements Button
{
    public function paint()
    {
        echo "Rendering a button in macOS style\n";
    }
}

class MacCheckbox implements Checkbox
{
    public function paint()
    {
        echo "Rendering a checkbox in macOS style\n";
    }
}

#Abstract Factory (Interface)
interface GUIFactory
{
    public function createButton(): Button;
    public function createCheckbox(): Checkbox;
}
#Concrete Factories (Các lớp cụ thể)

class WinFactory implements GUIFactory
{
    public function createButton(): Button
    {
        return new WinButton();
    }

    public function createCheckbox(): Checkbox
    {
        return new WinCheckbox();
    }
}

class MacFactory implements GUIFactory
{
    public function createButton(): Button
    {
        return new MacButton();
    }

    public function createCheckbox(): Checkbox
    {
        return new MacCheckbox();
    }
}
/**
 * Client Code
 *Client chỉ làm việc với các interface và abstract class mà không cần biết 
 *về các lớp cụ thể như WinButton, MacButton, WinCheckbox, hay MacCheckbox.
 */
// Hàm lấy factory phù hợp dựa trên loại hệ điều hành
function getFactory(string $osType): GUIFactory
{
    if ($osType === 'Windows') {
        return new WinFactory();
    } elseif ($osType === 'macOS') {
        return new MacFactory();
    }
    throw new Exception("Unsupported OS type");
}

// Main client code
function main()
{
    // Giả sử hệ điều hành hiện tại là Windows
    $osType = 'Windows';

    // Lấy factory phù hợp dựa trên hệ điều hành
    $factory = getFactory($osType);

    // Tạo button và checkbox thông qua factory
    $button = $factory->createButton();
    $checkbox = $factory->createCheckbox();

    // Sử dụng button và checkbox
    $button->paint();
    $checkbox->paint();
}

main();
