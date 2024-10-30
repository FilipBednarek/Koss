<?php
session_start();

// Inicjalizacja koszyka, jeśli nie istnieje
if (!isset($_SESSION['koszyk'])) {
    $_SESSION['koszyk'] = [];
}

// Lista produktów AGD
$produkty = [
    ['id' => 1, 'nazwa' => 'Lodówka', 'cena' => 1500],
    ['id' => 2, 'nazwa' => 'Pralka', 'cena' => 1200],
    ['id' => 3, 'nazwa' => 'Zmywarka', 'cena' => 900],
    ['id' => 4, 'nazwa' => 'Mikrofalówka', 'cena' => 300],
];

// Dodawanie produktów do koszyka
if (isset($_GET['dodaj'])) {
    $produktId = (int)$_GET['dodaj'];
    foreach ($produkty as $produkt) {
        if ($produkt['id'] === $produktId) {
            $_SESSION['koszyk'][] = $produkt;
            break;
        }
    }
}

// Obliczanie łącznej ceny koszyka
function obliczCeneKoszyka()
{
    $cenaCalkowita = 0;
    foreach ($_SESSION['koszyk'] as $produkt) {
        $cenaCalkowita += $produkt['cena'];
    }
    return $cenaCalkowita;
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Koszyk AGD</title>
</head>
<body>
    <h1>Lista produktów AGD</h1>
    <ul>
        <?php foreach ($produkty as $produkt): ?>
            <li>
                <?php echo $produkt['nazwa']; ?> - <?php echo $produkt['cena']; ?> PLN
                <a href="?dodaj=<?php echo $produkt['id']; ?>">Dodaj do koszyka</a>
            </li>
        <?php endforeach; ?>
    </ul>

    <h2>Twój koszyk</h2>
    <?php if (!empty($_SESSION['koszyk'])): ?>
        <ul>
            <?php foreach ($_SESSION['koszyk'] as $produkt): ?>
                <li><?php echo $produkt['nazwa']; ?> - <?php echo $produkt['cena']; ?> PLN</li>
            <?php endforeach; ?>
        </ul>
        <p><strong>Łączna cena:</strong> <?php echo obliczCeneKoszyka(); ?> PLN</p>
    <?php else: ?>
        <p>Koszyk jest pusty.</p>
    <?php endif; ?>
</body>
</html>
