<style>
    .result-style {
        display: none; 
    }
</style>

<div class="container">
    <form id="styleQuizForm" class="d-flex justify-content-center">
        <div id="quizContainer" class="col-6">
            <!-- Question 1 -->
            <div class="card question-card card-color">
                <div class="card-body white_btn2 text-center">
                    <h5 class="card-title mb-2">Which environment appeals to you most?</h5>
                    <select class="form-control mt-3" name="q1" required>
                        <option value="">Select</option>
                        <option value="a">Rustic countryside</option>
                        <option value="b">Urban streets</option>
                        <option value="c">Victorian-inspired settings</option>
                        <option value="d">Retro-futuristic aesthetics</option>
                        <option value="e">Academic libraries and old buildings</option>
                    </select>
                    <button type="button" class="btn btn-secondary border-0 rounded-1 mt-3 px-3 next-question">Next</button>
                </div>
            </div>
            <!-- Question 2 -->
            <div class="card question-card card-color" style="display: none;">
                <div class="card-body white_btn2 text-center">
                    <h5 class="card-title mb-2">What colors do you prefer in your wardrobe?</h5>
                    <select class="form-control mt-3" name="q2" required>
                        <option value="">Select</option>
                        <option value="a">Earthy tones and floral prints</option>
                        <option value="b">Bold and edgy hues</option>
                        <option value="c">Dark and mysterious shades</option>
                        <option value="d">Bright and pastel colors</option>
                        <option value="e">Classic and neutral palettes</option>
                    </select>
                    <button type="button" class="btn btn-secondary border-0 rounded-1 mt-3 px-3 next-question">Next</button>
                </div>
            </div>
            <!-- Question 3 -->
            <div class="card question-card card-color" style="display: none;">
                <div class="card-body white_btn2 text-center">
                    <h5 class="card-title mb-2">How would you describe your fashion vibe?</h5>
                    <select class="form-control mt-3" name="q3" required>
                        <option value="">Select</option>
                        <option value="a">Whimsical and nature-inspired</option>
                        <option value="b">Confident and alluring</option>
                        <option value="c">Elegant and intricate</option>
                        <option value="d">Trendy and nostalgic</option>
                        <option value="e">Intellectual and refined</option>
                    </select>
                    <button type="button" class="btn btn-secondary border-0 rounded-1 mt-3 px-3 next-question">Next</button>
                </div>
            </div>
            <!-- Question 4 -->
            <div class="card question-card card-color" style="display: none;">
                <div class="card-body white_btn2 text-center">
                    <h5 class="card-title mb-2">Which accessories do you gravitate towards?</h5>
                    <select class="form-control mt-3" name="q4" required>
                        <option value="">Select</option>
                        <option value="a">Flower crowns and vintage jewelry</option>
                        <option value="b">Chokers and statement pieces</option>
                        <option value="c">Lace gloves and parasols</option>
                        <option value="d">Mini backpacks and chunky sneakers</option>
                        <option value="e">Vintage glasses and leather bags</option>
                    </select>
                    <button type="button" class="btn btn-secondary border-0 rounded-1 mt-3 px-3 next-question">Next</button>
                </div>
            </div>
            <!-- Question 5 -->
            <div class="card question-card card-color" style="display: none;">
                <div class="card-body white_btn2 text-center">
                    <h5 class="card-title mb-2">What cultural influences resonate with you?</h5>
                    <select class="form-control mt-3" name="q5" required>
                        <option value="">Select</option>
                        <option value="a">Rural and folk traditions</option>
                        <option value="b">Urban and street culture</option>
                        <option value="c">Victorian and Gothic motifs</option>
                        <option value="d">2000s pop culture</option>
                        <option value="e">Classical literature and art</option>
                    </select>
                    <button type="button" class="btn btn-secondary border-0 rounded-1 mt-3 px-3 next-question">Next</button>
                </div>
            </div>
            <!-- Question 6 -->
            <div class="card question-card card-color" style="display: none;">
                <div class="card-body white_btn2 text-center">
                    <h5 class="card-title mb-2">What type of patterns do you enjoy wearing?</h5>
                    <select class="form-control mt-3" name="q6" required>
                        <option value="">Select</option>
                        <option value="a">Gingham and floral prints</option>
                        <option value="b">Leopard print and plaid</option>
                        <option value="c">Lace and ruffles</option>
                        <option value="d">Tie-dye and graffiti motifs</option>
                        <option value="e">Houndstooth and tweed</option>
                    </select>
                    <button type="button" class="btn btn-secondary border-0 rounded-1 mt-3 px-3 next-question">Next</button>
                </div>
            </div>
            <!-- Question 7 -->
            <div class="card question-card card-color" style="display: none;">
                <div class="card-body white_btn2 text-center">
                    <h5 class="card-title mb-2">Which era's fashion resonates most with you?</h5>
                    <select class="form-control mt-3" name="q7" required>
                        <option value="">Select</option>
                        <option value="a">Victorian and Edwardian eras</option>
                        <option value="b">1990s and early 2000s</option>
                        <option value="c">Rococo and Baroque periods</option>
                        <option value="d">1980s and 1990s</option>
                        <option value="e">Renaissance and medieval times</option>
                    </select>
                    <button type="button" class="btn btn-secondary border-0 rounded-1 mt-3 px-3 next-question">Next</button>
                </div>
            </div>
            <!-- Question 8 -->
            <div class="card question-card card-color" style="display: none;">
                <div class="card-body white_btn2 text-center">
                    <h5 class="card-title mb-2">Describe your ideal outfit silhouette</h5>
                    <select class="form-control mt-3" name="q8" required>
                        <option value="">Select</option>
                        <option value="a">Flowy and romantic</option>
                        <option value="b">Form-fitting and daring</option>
                        <option value="c">Fitted bodices and voluminous skirts</option>
                        <option value="d">Oversized and casual</option>
                        <option value="e">Structured and tailored</option>
                    </select>
                    <button type="button" class="btn btn-secondary border-0 rounded-1 mt-3 px-3 next-question">Next</button>
                </div>
            </div>
            <!-- Question 9 -->
            <div class="card question-card card-color" style="display: none;">
                <div class="card-body white_btn2 text-center">
                    <h5 class="card-title mb-2">Which footwear do you prefer?</h5>
                    <select class="form-control mt-3" name="q9" required>
                        <option value="">Select</option>
                        <option value="a">Vintage-inspired boots and Mary Janes</option>
                        <option value="b">Stiletto heels and platform sneakers</option>
                        <option value="c">Victorian-style lace-up boots</option>
                        <option value="d">Chunky sneakers and combat boots</option>
                        <option value="e">Oxfords and loafers</option>
                    </select>
                    <button type="button" class="btn btn-secondary border-0 rounded-1 mt-3 px-3 next-question">Next</button>
                </div>
            </div>
            <!-- Question 10 -->
            <div class="card question-card card-color" style="display: none;">
                <div class="card-body white_btn2 text-center">
                    <h5 class="card-title mb-2">What do you enjoy doing in your free time?</h5>
                    <select class="form-control mt-3" name="q10" required>
                        <option value="">Select</option>
                        <option value="a">Gardening and baking</option>
                        <option value="b">Going to parties and social events</option>
                        <option value="c">Reading Gothic literature and attending masquerade balls</option>
                        <option value="d">Exploring urban areas and attending concerts</option>
                        <option value="e">Visiting museums and attending lectures</option>
                    </select>
                    <button type="button" class="btn btn-secondary border-0 rounded-1 mt-3 px-3 show-result">Show My Style</button>
                </div>
            </div>
        </div>
        <!-- Result section -->
        <div class= "question-card"id="resultContainer">
            <div class="card card-color">
                <div class="card-body white_btn2 text-center">
                    <h5 class="card-title mb-3">Your style is:</h5>
                    <h6 class="card-subtitle mb-2 text-white" id="styleResult" style="font-size: 1.5rem;"></h6>
                    <button type="button" class="btn btn-secondary border-0 rounded-1 mt-3 px-3 ms-auto restart-quiz">Restart Quiz</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
(function() {
    const styles = {
    'Cottagecore': ['a', 'b', 'c', 'd', 'e', 'a', 'b', 'c', 'd', 'e'],
    'Coquette': ['a', 'b', 'c', 'd', 'e', 'a', 'b', 'c', 'd', 'e'],
    'Gothic Lolita': ['a', 'b', 'c', 'd', 'e', 'a', 'b', 'c', 'd', 'e'],
    'Streetwear': ['a', 'b', 'c', 'd', 'e', 'a', 'b', 'c', 'd', 'e'],
    'Y2K': ['a', 'b', 'c', 'd', 'e', 'a', 'b', 'c', 'd', 'e'],
    'Dark Academia': ['a', 'b', 'c', 'd', 'e', 'a', 'b', 'c', 'd', 'e'],
    'Old Money': ['a', 'b', 'c', 'd', 'e', 'a', 'b', 'c', 'd', 'e'],
    'Alt': ['a', 'b', 'c', 'd', 'e', 'a', 'b', 'c', 'd', 'e'],
    'Indie': ['a', 'b', 'c', 'd', 'e', 'a', 'b', 'c', 'd', 'e'],
    'Star Girl': ['a', 'b', 'c', 'd', 'e', 'a', 'b', 'c', 'd', 'e']
};

    const randomizeOptions = () => {
        const styleKeys = Object.keys(styles);
        styleKeys.forEach(key => {
            styles[key] = shuffle(styles[key]);
        });
    };

    const shuffle = (array) => {
        let currentIndex = array.length, temporaryValue, randomIndex;

        while (0 !== currentIndex) {

            randomIndex = Math.floor(Math.random() * currentIndex);
            currentIndex -= 1;

            temporaryValue = array[currentIndex];
            array[currentIndex] = array[randomIndex];
            array[randomIndex] = temporaryValue;
        }

        return array;
    };

    const calculateStyle = () => {
        const answers = document.querySelectorAll('.question-card select');
        const styleScores = {
            'Cottagecore': 0,
            'Coquette': 0,
            'Gothic Lolita': 0,
            'Streetwear': 0,
            'Y2K': 0,
            'Dark Academia': 0,
            'Old Money': 0,
            'Alt': 0,
            'Indie': 0,
            'Star Girl': 0
        };

        answers.forEach((answer, index) => {
            const selectedAnswer = answer.value;
            const questionNumber = index + 1;
            console.log(`Answer for question ${questionNumber}: ${selectedAnswer}`);
            for (const style in styles) {
                if (styles[style][questionNumber - 1] === selectedAnswer) {
                    console.log(`Style ${style} scored!`);
                    styleScores[style]++;
                }
            }
        });

        // Find the style with the highest score
        let maxScore = 0;
        let predominantStyle = '';
        for (const [style, score] of Object.entries(styleScores)) {
            if (score > maxScore) {
                maxScore = score;
                predominantStyle = style;
            }
        }

        return predominantStyle;
    };

    const questions = document.querySelectorAll('.question-card');
    const resultContainer = document.getElementById('resultContainer');
    const styleResult = document.getElementById('styleResult');

    let currentQuestionIndex = 0;

    const showQuestion = (index) => {
        questions.forEach((question, i) => {
            if (i === index) {
                question.style.display = 'block';
                randomizeOptions(); // Randomize options when displaying a question
            } else {
                question.style.display = 'none';
            }
        });
    };

    const showResult = () => {
        // Calculate style based on user's answers
        const style = calculateStyle();
        // Display the result
        styleResult.textContent = style !== '' ? style : "Undetermined";
        // Hide questions and show result
        document.getElementById('quizContainer').style.display = 'none';
        resultContainer.style.display = 'block';
    };

    const restartQuiz = () => {
        currentQuestionIndex = 0;
        showQuestion(currentQuestionIndex);
        document.getElementById('quizContainer').style.display = 'block';
        resultContainer.style.display = 'none';
    };

    document.querySelectorAll('.next-question').forEach(button => {
        button.addEventListener('click', () => {
            currentQuestionIndex++;
            showQuestion(currentQuestionIndex);
        });
    });

    document.querySelector('.show-result').addEventListener('click', showResult);
    document.querySelector('.restart-quiz').addEventListener('click', restartQuiz);

    // Show the first question initially
    showQuestion(currentQuestionIndex);
})();
</script>