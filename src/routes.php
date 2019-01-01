<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes

$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});

// get jenis kesenian
$app->get("/jeniskesenian/", function (Request $request, Response $response){
    $sql = "SELECT * FROM tb_jeniskesenian";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $response->withJson(["status" => "success", "data" => $result], 200);
});

// get kelurahan
$app->get("/kelurahan/", function (Request $request, Response $response){
    $sql = "SELECT * FROM tb_kelurahan";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $response->withJson(["status" => "success", "data" => $result], 200);
});

// get lingkunganseni
$app->get("/lingkunganseni/", function (Request $request, Response $response){
    $sql = "SELECT * FROM tb_lingkunganseni";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $response->withJson(["status" => "success", "data" => $result], 200);
});

// get lingkunganseni by id_jenisseni
$app->get("/lingkunganseni/search/", function (Request $request, Response $response, $args){
    $keyword = $request->getQueryParam("keyword");
    $sql = "SELECT * FROM tb_lingkunganseni WHERE tag_jeniskesenian LIKE '%$keyword%'";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $response->withJson(["status" => "success", "data" => $result], 200);
});

// get lingkunganseni by id_kelurahan
$app->get("/lingkunganseni/{id}", function (Request $request, Response $response, $args){
    $id = $args["id"];
    $sql = "SELECT * FROM tb_lingkunganseni WHERE fk_kelurahan=:id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute([":id" => $id]);
    $result = $stmt->fetchAll();
    return $response->withJson(["status" => "success", "data" => $result], 200);
});

// search lingkungansenin
$app->get("/lingkunganseni/search/", function (Request $request, Response $response, $args){
    $keyword = $request->getQueryParam("keyword");
    $sql = "SELECT * FROM lingkunganseni WHERE nama_lingkunganseni LIKE '%$keyword%' ";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $response->withJson(["status" => "success", "data" => $result], 200);
});
