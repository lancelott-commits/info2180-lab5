<?php

$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$country = $_GET['country'] ?? '';
$lookup = $_GET['lookup'] ?? 'country';



$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

if ($lookup === "cities") {
    $stmt = $conn->prepare(
        "SELECT countries.name AS country_name, cities.name AS city_name, cities.district, cities.population
         FROM cities
         JOIN countries ON cities.country_code = countries.code
         WHERE countries.name LIKE :country
         ORDER BY countries.name, cities.name"
    );
    $stmt->execute([':country' => "%$country%"]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <table>
      <thead>
        <tr>
          <th>Country</th>
          <th>City Name</th>
          <th>District</th>
          <th>Population</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($results as $row): ?>
          <tr>
            <td><?= $row['country_name']; ?></td>
            <td><?=  $row['city_name']; ?></td>
            <td><?= $row['district']; ?></td>
            <td><?= $row['population']; ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <?php
}
else{
  $stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");

 $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

 ?>

 <table>
  <thead>
    <tr> 
      <th> Country Name </th>
      <th> Continent </th>
      <th> Year of independence </th>
      <th>  Head of State   </th>
    </tr>
  </thead>
  <tbody> 
    <?php foreach ($results as $row): ?>
      <tr> 
        <td> <?= $row['name']; ?>   </td>
        <td> <?= $row['continent']; ?>  </td>
        <td> <?= $row['independence_year']; ?>  </td>
        <td> <?= $row['head_of_state']; ?>  </td>
      </tr>
    <?php endforeach; ?>
  </tbody>

  </table>
  <?php
}
    



