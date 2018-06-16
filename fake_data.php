<?php
/**
 * Created by PhpStorm.
 * User: wolfs
 * Date: 10/31/2017
 * Time: 7:50 AM
 */
include 'templates/header.php';
include 'templates/functions.php';
require_once 'autoload.php';

$db = db_connect();
$faker = Faker\Factory::create();



for ($i = 0; $i < 40; $i++) {
  $name = $faker->name;
  $location = $faker->address;
  $priceRangeLow = rand(1, 10);
  $priceRangeHigh = rand(10, 100);
  $tags = $faker->bs;

  $sql = "INSERT INTO `products` (`id`, `name`, `location`, `priceRangeLow`, `priceRangeHigh`, `tags`, `modifiedAt`, `createdAt`) VALUES (NULL, '$name', '$location', '$priceRangeLow', '$priceRangeHigh', '$tags', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
  echo "$sql";
  $result = $db->query($sql);
  $productIDFK = $db->insert_id;

  $num_reviews = rand(0, 10);
  for($j = 0; $j < $num_reviews; $j++){
    $author = $faker->name;
    $review_text= $faker->bs;
    $rating = rand(1, 5);

    $sql = "INSERT INTO reviews (id, author, review, rating, created_at, productIDFK) 
          VALUES (NULL, '$author', '$review_text', '$rating', NOW(), '$productIDFK')";
    $result = $db->query($sql);
  }
}

//for ($i = 0; $i < 5; $i++) {
//  $title = $faker->company;
//  $author = $faker->name;
//  $article_text = $faker->text(500);
//  $published_date = $faker->dateTime;
//  $modified_at = $faker->dateTimeAD;
//
//  $published_date = date_create()->format("Y-m-d H:i:s");
//  $modified_at = date_create()->format("Y-m-d H:i:s");
//
//  echo "$title . <br>";
//  echo "$author . <br>";
//  echo "$article_text . <br>";
//  echo "$published_date . <br>";
//  echo "$modified_at . <br>";
//  echo "<br>";
//}

?>