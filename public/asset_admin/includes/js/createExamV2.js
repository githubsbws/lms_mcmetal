const targetShow = document.getElementById("targetShow");
const targetCount = document.getElementById("targetCount");


$(document).ready(async function() {
    await setShowCount()
});

let questions = {
    currentQuestion: [
        // {
        //     questionId: '',
        //     questionType: '',  // multipleChoiceOneAnswer | mutipleChoiceMultipleAnser | describe | matching | ordering
        //     choice: [
        //         {
    
        //         }
        //     ],
        //     deletedChoice: []
        // }
    ],
    deletedQuestion: []
}
let wrongAnswer = [
    // {
    //     questionId: '',
    //     choice: [],
    //     deletedChoice: []
    // }
]

async function setShowCount() {
    targetCount.innerHTML = questions.currentQuestion.length;
}

async function callSummernote(){
    $('.summernote').summernote({
        placeholder: 'กรอกข้อมูลที่ต้องการ',
        height: 100
    });
}

async function createChoice(choiceType, questionId) {

    const checkValue = questions.currentQuestion.filter((question) => {
        return question.questionId == questionId
    })
    const index = questions.currentQuestion.indexOf(checkValue[0]);
    const data = questions.currentQuestion[index]

    let choiceId = 0
    
    if(data.deletedChoice.length > 0){
        choiceId = questions.currentQuestion[index].deletedChoice.shift()
    }else{
        choiceId = questions.currentQuestion[index].choice.length
    }

    // Create div
    const box = document.createElement("div");

    switch(choiceType){
        case 'radio':
            $(box).attr({
                'id': `Q${questionId}_Choice${choiceId}`,
                'class': 'group'
            });
            $(box).append(`
                <label for="Q${questionId}_choice${choiceId}" class="w-100 font-weight-normal cursor-pointer d-flex mb-3 border rounded-lg">
                    <input type="${choiceType}" class="d-none" name="Q${questionId}_Choice" id="Q${questionId}_choice${choiceId}" />
                    <div class="px-2 py-3 d-flex align-items-center choiceIcons">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="w-100 p-2">
                        <div class="d-flex align-items-center d-inline mb-1">
                            <p class="mb-0">เลือกข้อนี้เป็นข้อที่ถูก</p>
                            <button class="btn btn-danger btn-sm px-3 py-1 ml-2" onclick="deleteChoice(${choiceId}, ${questionId});">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                        <input type="text" class="form-control" />
                    </div>
                </label>
            `)
            $(`#Q${questionId}_ChoiceSection`).append(box)
            break
        case 'checkbox':
            $(box).attr({
                'id': `Q${questionId}_Choice${choiceId}`,
                'class': 'group'
            });
            $(box).append(`
                <label for="Q${questionId}_choice${choiceId}" class="w-100 font-weight-normal cursor-pointer d-flex mb-3 border rounded-lg">
                    <input type="${choiceType}" class="d-none" name="Q${questionId}_Choice" id="Q${questionId}_choice${choiceId}" />
                    <div class="px-2 py-3 d-flex align-items-center choiceIcons">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="w-100 p-2">
                        <div class="d-flex align-items-center d-inline mb-1">
                            <p class="mb-0">เลือกข้อนี้เป็นข้อที่ถูก</p>
                            <button class="btn btn-danger btn-sm px-3 py-1 ml-2" onclick="deleteChoice(${choiceId}, ${questionId});">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                        <input type="text" class="form-control" />
                    </div>
                </label>
            `)
            $(`#Q${questionId}_ChoiceSection`).append(box)
            break
        case 'matching':
            $(box).attr({
                'id': `Q${questionId}_Choice${choiceId}`,
                'class': 'group'
            });
            $(box).append(`
                <div class="mb-3 p-2 border rounded-lg">
                    <div class="d-flex align-items-center d-inline mb-1">
                        <p class="mb-0"></p>
                        <button class="btn btn-danger btn-sm px-3 py-1" onclick="deleteChoice(${choiceId}, ${questionId});">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    <div class="row">
                        <div class="col">
                            <lable>คำถาม</lable>
                            <input type="text" class="form-control" />
                        </div>
                        <div class="col">
                            <lable>คำตอบ</lable>
                            <input type="text" class="form-control" />
                        </div>
                    </div>
                </div>
            `)
            $(`#Q${questionId}_ChoiceSection`).append(box)
            callSummernote()
            break
        case 'ordering':
            $(box).attr({
                'id': `Q${questionId}_Choice${choiceId}`,
                'class': 'group'
            });
            $(box).append(`
                <div class="mb-3 p-2 border rounded-lg">
                    <div class="d-flex align-items-center d-inline mb-1">
                        <p class="mb-0"></p>
                        <button class="btn btn-danger btn-sm px-3 py-1" onclick="deleteChoice(${choiceId}, ${questionId});">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    <textarea name="question_${questionId}" class="summernote"></textarea>
                </div>
            `)
            $(`#Q${questionId}_ChoiceSection`).append(box)
            callSummernote()
            break
    }
    questions.currentQuestion[index].choice.push(choiceId)
}

async function deleteChoice(choiceId, questionId) {
    $(`#Q${questionId}_Choice${choiceId}`).remove();

    const data = questions.currentQuestion.filter((question) => {
        return question.questionId == questionId
    })

    if(data.length > 0){
        const index = questions.currentQuestion.indexOf(data[0]);
        questions.currentQuestion[index].deletedChoice.push(choiceId)

        const choiceData = data[0].choice
        const clearDeletedData = choiceData.filter((choices) => {
            return choices !== choiceId
        })

        questions.currentQuestion[index].choice = clearDeletedData
        if(questions.currentQuestion[index].choice.length == 0){
            questions.currentQuestion[index].choice = []
        }
    }

}

async function setupQuestion(questionType) {
    
    let deletedCount = questions.deletedQuestion.length

    if(deletedCount > 0){

        let questionId = questions.deletedQuestion.shift()
        questions.deletedQuestion = questions.deletedQuestion.filter((items) => {
            return items !== questionId
        })
        questions.currentQuestion.push({
            questionId: questionId,
            questionType: questionType,
            choice: [],
            deletedChoice: []
        })
        await createQuestion(questionType, questionId)
    }else{

        let questionId = questions.currentQuestion.length
        questions.currentQuestion.push({
            questionId: questionId,
            questionType: questionType,
            choice: [],
            deletedChoice: []
        })

        await createQuestion(questionType, questionId)
    }
    await callSummernote()
    await setShowCount()
}

async function createQuestion(questionType, questionId) {

    const box = document.createElement("div");
    $(box).attr({
        'id': `Q${questionId}`,
        'class': 'card'
    });
    
    switch(questionType){
        case 'multipleChoiceOneAnswer':
            $(box).append(`
                <div class="card-header font-weight-bold bg-secondary d-flex align-items-center">
                    ข้อสอบคำตอบเดียว
                    <button class="btn btn-danger btn-sm px-3 py-1 ml-auto" onclick="deleteQuestion(${questionId});">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
                <div class="card-body">
                    <div class="section mb-3">
                        <p class="font-weight-bold mb-2">โจทย์</p>
                        <textarea name="question_${questionId}" class="summernote"></textarea>
                    </div>
                    <div class="section mb-3">
                        <p class="font-weight-bold mb-2">คำอธิบาย</p>
                        <textarea name="describe_${questionId}" class="summernote"></textarea>
                    </div>
                    <div class="section choice" id="Q${questionId}_ChoiceSection">
                        <div class="d-flex align-items-center mb-2">
                            <p class="font-weight-bold mb-0">ตัวเลือก</p>
                            <button class="btn btn-sm btn-primary ml-2" onclick="createChoice('radio', ${questionId})">
                                เพิ่มคำตอบ
                            </button>
                        </div>
                    </div>
                </div>
            `);
            break
        case 'mutipleChoiceMultipleAnser':
            $(box).append(`
                <div class="card-header font-weight-bold bg-secondary d-flex align-items-center">
                    ข้อสอบหลายคำตอบ
                    <button class="btn btn-danger btn-sm px-3 py-1 ml-auto" onclick="deleteQuestion(${questionId});">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
                <div class="card-body">
                    <div class="section mb-3">
                        <p class="font-weight-bold mb-2">โจทย์</p>
                        <textarea name="question_${questionId}" class="summernote"></textarea>
                    </div>
                    <div class="section mb-3">
                        <p class="font-weight-bold mb-2">คำอธิบาย</p>
                        <textarea name="describe_${questionId}" class="summernote"></textarea>
                    </div>
                    <div class="section choice" id="Q${questionId}_ChoiceSection">
                        <div class="d-flex align-items-center mb-2">
                            <p class="font-weight-bold mb-0">ตัวเลือก</p>
                            <button class="btn btn-sm btn-primary ml-2" onclick="createChoice('checkbox', ${questionId})">
                                เพิ่มคำตอบ
                            </button>
                        </div>
                    </div>
                </div>
            `);
            await createChoice('checkbox', questionId)
            await createChoice('checkbox', questionId)
            break
        case 'describe':
            $(box).append(`
                <div class="card-header font-weight-bold bg-secondary d-flex align-items-center">
                    ข้อสอบบรรยาย
                    <button class="btn btn-danger btn-sm px-3 py-1 ml-auto" onclick="deleteQuestion(${questionId});">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
                <div class="card-body">
                    <div class="section mb-3">
                        <p class="font-weight-bold mb-2">คะแนนเต็ม</p>
                        <input name="question_${questionId}_FullScore" type='number' class="form-control" />
                    </div>
                    <div class="section">
                        <p class="font-weight-bold mb-2">โจทย์</p>
                        <textarea name="question_${questionId}" class="summernote"></textarea>
                    </div>
                </div>
            `);
            break
        case 'matching':
            $(box).append(`
                <div class="card-header font-weight-bold bg-secondary d-flex align-items-center">
                    ข้อสอบจับคู่
                    <button class="btn btn-danger btn-sm px-3 py-1 ml-auto" onclick="deleteQuestion(${questionId});">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
                <div class="card-body">
                    <div class="section mb-3">
                        <p class="font-weight-bold mb-2">โจทย์</p>
                        <textarea name="question_${questionId}" class="summernote"></textarea>
                    </div>
                    <div class="section mb-3">
                        <p class="font-weight-bold mb-2">คำอธิบาย</p>
                        <textarea name="describe_${questionId}" class="summernote"></textarea>
                    </div>
                    <div class="section mb-3" id="Q${questionId}_ChoiceSection">
                        <div class="d-flex align-items-center mb-2">
                            <p class="font-weight-bold mb-0">ตัวเลือก</p>
                            <button class="btn btn-sm btn-primary ml-2" onclick="createChoice('matching', ${questionId})">
                                เพิ่มคำตอบ
                            </button>
                        </div>
                    </div>
                    <div class="section" id="Q${questionId}_WrongAnswerSection">
                        <div class="d-flex align-items-center mb-2">
                            <p class="font-weight-bold mb-0">คำตอบหลอก</p>
                            <button class="btn btn-sm btn-primary ml-2" onclick="createWrongAnswer(${questionId})">
                                เพิ่มคำตอบ
                            </button>
                        </div>
                    </div>
                </div>
            `);
            break
        case 'ordering':
            $(box).append(`
                <div class="card-header font-weight-bold bg-secondary d-flex align-items-center">
                    ข้อสอบจัดเรียงคำตอบ
                    <button class="btn btn-danger btn-sm px-3 py-1 ml-auto" onclick="deleteQuestion(${questionId});">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
                <div class="card-body">
                    <div class="section mb-3">
                        <p class="font-weight-bold mb-2">โจทย์</p>
                        <textarea name="question_${questionId}" class="summernote"></textarea>
                    </div>
                    <div class="section mb-3">
                        <p class="font-weight-bold mb-2">คำอธิบาย</p>
                        <textarea name="describe_${questionId}" class="summernote"></textarea>
                    </div>
                    <div class="section choice" id="Q${questionId}_ChoiceSection">
                        <div class="d-flex align-items-center mb-2">
                            <p class="font-weight-bold mb-0">ตัวเลือก</p>
                            <button class="btn btn-sm btn-primary ml-2" onclick="createChoice('ordering', ${questionId})">
                                เพิ่มคำตอบ
                            </button>
                        </div>
                    </div>
                </div>
            `);
            break
    }
    $(targetShow).append(box);
}

async function createWrongAnswer(questionId) {

    let checkValue = wrongAnswer.filter((question) => {
        return question.questionId == questionId
    })

    if(checkValue.length < 1){
        wrongAnswer.push(
            {
                questionId: questionId,
                choice: [],
                deletedChoice: []
            }
        )
    }

    let currentData = wrongAnswer.filter((question) => {
        return question.questionId == questionId
    })

    const index = wrongAnswer.indexOf(currentData[0]);
    const data = wrongAnswer[index]

    let choiceId = 0
    
    if(data.deletedChoice.length > 0){
        choiceId = wrongAnswer[index].deletedChoice.shift()
    }else{
        choiceId = wrongAnswer[index].choice.length
    }

    const box = document.createElement("div");

    $(box).attr({
        'id': `Q${questionId}_WrongAnswerChoice${choiceId}`,
        'class': 'group'
    });
    $(box).append(`
        <div class="mb-3 p-2 border rounded-lg">
            <div class="d-flex align-items-center d-inline mb-1">
                <p class="mb-0"></p>
                <button class="btn btn-danger btn-sm px-3 py-1" onclick="deleteWrongAnswer(${choiceId}, ${questionId});">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
            <lable>คำตอบหลอก</lable>
            <input type="text"  class="form-control" />
        </div>

    `)
    $(`#Q${questionId}_WrongAnswerSection`).append(box)
    wrongAnswer[index].choice.push(choiceId)
    console.log(wrongAnswer)
}

async function deleteWrongAnswer(choiceId, questionId) {
    $(`#Q${questionId}_WrongAnswerChoice${choiceId}`).remove();

    const data = wrongAnswer.filter((question) => {
        return question.questionId == questionId
    })

    if(data.length > 0){
        const index = wrongAnswer.indexOf(data[0]);
        wrongAnswer[index].deletedChoice.push(choiceId)

        const choiceData = data[0].choice
        const clearDeletedData = choiceData.filter((choices) => {
            return choices !== choiceId
        })

        wrongAnswer[index].choice = clearDeletedData

        if(wrongAnswer[index].choice.length == 0){
            wrongAnswer[index].deletedChoice = []
        }
    }
    console.log(wrongAnswer)
}

async function deleteQuestion(questionId) {
    $(`#Q${questionId}`).remove();

    questions.currentQuestion = questions.currentQuestion.filter((question) => {
        return question.questionId !== questionId
    })
    questions.deletedQuestion.push(questionId)
    const countCurrent = questions.currentQuestion.length

    if(countCurrent == 0){
        questions.deletedQuestion = []
    }

    const checkWrongAnswerData = wrongAnswer.filter((question) => {
        return question.questionId == questionId
    })

    if(checkWrongAnswerData.length > 0){
        wrongAnswer = wrongAnswer.filter((question) => {
            return question.questionId !== questionId
        })
    }

    await setShowCount()
    console.log(wrongAnswer)
}