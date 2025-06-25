let attempts = 0;

async function checkAnswer(questionNumber) {
    const answer = document.getElementById(`answer${questionNumber}`).value;
    console.log(`Pergunta ${questionNumber}, resposta fornecida: ${answer}`);

    try {
        const response = await fetch('../php/check_answer.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ questionNumber, answer }),
        });

        if (!response.ok) {
            throw new Error('Erro na requisição');
        }

        const result = await response.json();
        console.log('Resposta do servidor:', result);

        if (result.correct) {
            alert("Resposta correta! Redirecionando para a próxima página...");
            window.location.href = "http://localhost/tes/index.php"; 
        } else {
            attempts++;
            if (attempts >= 3) {
                alert("Você errou todas as perguntas. Redirecionando para a tela anterior...");
                window.location.href = "http://localhost/tes/Pagina%20login/Pag_login.html"; 
            } else {
                alert("Resposta incorreta. Tente a próxima pergunta.");
                document.getElementById(`question${questionNumber}`).style.display = "none";
                document.getElementById(`question${questionNumber + 1}`).style.display = "block";
            }
        }
    } catch (error) {
        console.error('Erro:', error);
        alert('Ocorreu um erro. Tente novamente mais tarde.');
    }
}
