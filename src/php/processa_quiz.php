<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    header("Content-Type: application/json");

    // Respostas corretas
    $respostas_corretas = [
        "q1" => "200",
        "q2" => "8",
        "q3" => "12"
    ];

    // Respostas do usuário
    $respostas_usuario = $_POST;
    $resultado = [];

    // Verificando as respostas
    foreach ($respostas_corretas as $pergunta => $resposta_correta) {
        if (isset($respostas_usuario[$pergunta])) {
            $resposta_usuario = $respostas_usuario[$pergunta];

            // Verifica se a resposta está correta
            if ($resposta_usuario == $resposta_correta) {
                $resultado[$pergunta] = [
                    "correto" => true,
                    "mensagem" => "✅ Resposta correta!"
                ];
            } else {
                $resultado[$pergunta] = [
                    "correto" => false,
                    "mensagem" => "❌ Resposta errada! A correta é <strong>$resposta_correta</strong>."
                ];
            }
        } else {
            $resultado[$pergunta] = [
                "correto" => false,
                "mensagem" => "❌ Você não respondeu! A resposta correta é <strong>$resposta_correta</strong>."
            ];
        }
    }

    // Retorna o resultado como JSON
    echo json_encode($resultado);
} else {
    // Se o método não for POST, retorna erro
    http_response_code(405);
    echo "Método não permitido!";
}