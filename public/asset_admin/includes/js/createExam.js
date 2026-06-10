const targetShow = document.getElementById("targetShow");
const targetCount = document.getElementById("targetCount");

// Config Value
let choiceNum = 1

let question = {
    currentQuestion: [],
    deletedQuestion: []
}

let currentMultipleChoice = []
let matchingQuestion = []

targetCount.innerHTML = question.currentQuestion.length;

async function callSummernote(){
    $('.summernote').summernote({
        placeholder: 'กรอกข้อมูลที่ต้องการ',
        height: 100
    });
}

async function removechoice(targetID, choiceTarget, questionID){
    $(`#${targetID}`).remove();
    
    const checkValue = currentMultipleChoice.filter((question) => {
        return question.question == questionID
    })
    if(checkValue.length > 0){
        const index = currentMultipleChoice.indexOf(checkValue[0]);
        currentMultipleChoice[index].deletedChosie.push(choiceTarget);

        const mainData = checkValue[0].choice
        const clearDeletedData = mainData.filter((choices) => {
            return choices !== choiceTarget
        })

        currentMultipleChoice[index].choice = clearDeletedData;

    }else{

        console.error('Romove choice failed!')
    }
}

async function createchoice(type, question){

    const questionID = `${question}`

    const checkValue = currentMultipleChoice.filter((question) => {
        return question.question == questionID
    })
    const index = currentMultipleChoice.indexOf(checkValue[0]);
    const data = currentMultipleChoice[index]

    if(checkValue[0].deletedChosie.length > 0){

        const box = document.createElement("div");

        const deletedchoice = data.deletedChosie[0]
        const deletedQuestion = data.question

        $(box).attr({
            'id': `Q${deletedQuestion}_choiceSection${deletedchoice}`,
            'class': 'group'
        });
        $(box).append(`
            <label for="Q${deletedQuestion}_choice${deletedchoice}" class="w-100 font-weight-normal cursor-pointer d-flex mb-3 border rounded-lg">
                <input type="${type}" class="d-none" name="Q${deletedQuestion}_choice" id="Q${deletedQuestion}_choice${deletedchoice}" />
                <div class="px-2 py-3 d-flex align-items-center choiceIcons">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="w-100 p-2">
                    <div class="d-flex align-items-center d-inline mb-1">
                        <p class="mb-0">เลือกข้อนี้เป็นข้อที่ถูก</p>
                        <button class="btn btn-danger btn-sm px-3 py-1 ml-2" onclick="removechoice('Q${deletedQuestion}_choiceSection${deletedchoice}', ${deletedchoice}, '${deletedQuestion}');">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    <input type="text" class="form-control" />
                </div>
            </label>
        `)
        $(`#choiceSection_Q${deletedQuestion}`).append(box)

        currentMultipleChoice[index].deletedChosie.shift();
        currentMultipleChoice[index].choice.push(deletedchoice)
    }else{
        const box = document.createElement("div");
        const currentchoice = checkValue[0].choice.length
        currentMultipleChoice[index].choice.push(currentchoice)

        $(box).attr({
            'id': `Q${question}_choiceSection${currentchoice}`,
            'class': 'group'
        });
        $(box).append(`
            <label for="Q${question}_choice${currentchoice}" class="w-100 font-weight-normal cursor-pointer d-flex mb-3 border rounded-lg">
                <input type="${type}" class="d-none" name="Q${question}_choice" id="Q${question}_choice${currentchoice}" />
                <div class="px-2 py-3 d-flex align-items-center choiceIcons">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="w-100 p-2">
                    <div class="d-flex align-items-center d-inline mb-1">
                        <p class="mb-0">เลือกข้อนี้เป็นข้อที่ถูก</p>
                        <button class="btn btn-danger btn-sm px-3 py-1 ml-2" onclick="removechoice('Q${question}_choiceSection${currentchoice}', ${currentchoice}, '${question}');">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    <input type="text" class="form-control" />
                </div>
            </label>
        `)
        $(`#choiceSection_Q${question}`).append(box)
        
    }
}

async function createQuestion(questionID) {
    currentMultipleChoice.push({
        question: questionID,
        choice: [],
        deletedChosie: []
    })
}

async function addOneAnswerQuestion(){
    const box = document.createElement("div");
    $(box).attr({
        'id': `Question_${question.currentQuestion.length}`,
        'class': 'card'
    });
    $(box).append(`
        <div class="card-header font-weight-bold bg-secondary d-flex align-items-center">
            ข้อสอบคำตอบเดียว
            <button class="btn btn-danger btn-sm px-3 py-1 ml-auto" onclick="removeCount(${question.currentQuestion.length});">
                <i class="fas fa-trash"></i>
            </button>
        </div>
        <div class="card-body">
            <div class="section mb-3">
                <p class="font-weight-bold mb-2">โจทย์</p>
                <textarea name="Question_${question.currentQuestion.length}" class="summernote"></textarea>
            </div>
            <div class="section mb-3">
                <p class="font-weight-bold mb-2">คำอธิบาย</p>
                <textarea name="Question_${question.currentQuestion.length}" class="summernote"></textarea>
            </div>
            <div class="section choice" id="choiceSection_Q${question.currentQuestion.length}">
                <div class="d-flex align-items-center mb-2">
                    <p class="font-weight-bold mb-0">ตัวเลือก</p>
                    <button class="btn btn-sm btn-primary ml-2" onclick="createchoice('radio', '${question.currentQuestion.length}')">
                        เพิ่มคำตอบ
                    </button>
                </div>
            </div>
        </div>
    `);
    $(targetShow).append(box);
    await createQuestion(question.currentQuestion.length)
    await createchoice('radio', `${question.currentQuestion.length}`);
    await createchoice('radio', `${question.currentQuestion.length}`);
    await addCount();
};

async function addMultipleAnswerQuestion(){
    const box = document.createElement("div");
    $(box).attr({
        'id': `Question_${question.currentQuestion.length}`,
        'class': 'card'
    });
    $(box).append(`
        <div class="card-header font-weight-bold bg-secondary d-flex align-items-center">
            ข้อสอบหลายคำตอบ
            <button class="btn btn-danger btn-sm px-3 py-1 ml-auto" onclick="removeCount(${question.currentQuestion.length});">
                <i class="fas fa-trash"></i>
            </button>
        </div>
        <div class="card-body">
            <div class="section mb-3">
                <p class="font-weight-bold mb-2">โจทย์</p>
                <textarea name="Question_${question.currentQuestion.length}" class="summernote"></textarea>
            </div>
            <div class="section mb-3">
                <p class="font-weight-bold mb-2">คำอธิบาย</p>
                <textarea name="Question_${question.currentQuestion.length}" class="summernote"></textarea>
            </div>
            <div class="section choice" id="choiceSection_Q${question.currentQuestion.length}">
                <div class="d-flex align-items-center mb-2">
                    <p class="font-weight-bold mb-0">ตัวเลือก</p>
                    <button class="btn btn-sm btn-primary ml-2" onclick="createchoice('checkbox', '${question.currentQuestion.length}')">
                        เพิ่มคำตอบ
                    </button>
                </div>
            </div>
        </div>
    `);
    $(targetShow).append(box)
    await createQuestion(question.currentQuestion.length)
    await createchoice('checkbox', `${question.currentQuestion.length}`);
    await createchoice('checkbox', `${question.currentQuestion.length}`);
    await addCount();
};

async function addDescribeQuestion(){
    const box = document.createElement("div");
    $(box).attr({
        'id': `Question_${question.currentQuestion.length}`,
        'class': 'card'
    });
    $(box).append(`
        <div class="card-header font-weight-bold bg-secondary d-flex align-items-center">
            ข้อสอบบรรยาย
            <button class="btn btn-danger btn-sm px-3 py-1 ml-auto" onclick="removeCount(${question.currentQuestion.length});">
                <i class="fas fa-trash"></i>
            </button>
        </div>
        <div class="card-body">
            <div class="section mb-3">
                <p class="font-weight-bold mb-2">คะแนนเต็ม</p>
                <input name="Q${question.currentQuestion.length}_Score" type='number' class="form-control" />
            </div>
            <div class="section">
                <p class="font-weight-bold mb-2">โจทย์</p>
                <textarea name="Q${question.currentQuestion.length}_choice" class="summernote"></textarea>
            </div>
        </div>
    `);
    $(targetShow).append(box)
    await addCount();
};

async function createMatchingChoice(questionID) {
    
}

async function addMatchingQuestion(){
    const box = document.createElement("div");
    $(box).attr({
        'id': `Question_${question.currentQuestion.length}`,
        'class': 'card'
    });
    $(box).append(`
        <div class="card-header font-weight-bold bg-secondary d-flex align-items-center">
            ข้อสอบหลายคำตอบ
            <button class="btn btn-danger btn-sm px-3 py-1 ml-auto" onclick="removeCount(${question.currentQuestion.length});">
                <i class="fas fa-trash"></i>
            </button>
        </div>
        <div class="card-body">
            <div class="section mb-3">
                <p class="font-weight-bold mb-2">โจทย์</p>
                <textarea name="Question_${question.currentQuestion.length}" class="summernote"></textarea>
            </div>
            <div class="section mb-3">
                <p class="font-weight-bold mb-2">คำอธิบาย</p>
                <textarea name="Question_${question.currentQuestion.length}" class="summernote"></textarea>
            </div>
            <div class="section choice" id="choiceSection_Q${question.currentQuestion.length}">
                <div class="d-flex align-items-center mb-2">
                    <p class="font-weight-bold mb-0">ตัวเลือก</p>
                    <button class="btn btn-sm btn-primary ml-2" onclick="createMatchingChoice('${question.currentQuestion.length}')">
                        เพิ่มคำตอบ
                    </button>
                </div>
            </div>
        </div>
    `);
    $(targetShow).append(box)
    await createQuestion(question.currentQuestion.length)
    await addCount();
};

async function addOrderQuestion(){
    await addCount();
};

async function addCount(){
    const countDeletedQuestion = question.deletedQuestion.length

    if(countDeletedQuestion > 0){

        let deletedQuestion = question.deletedQuestion
        let targetID = deletedQuestion.shift()

        deletedQuestion = deletedQuestion.filter((items) => {
            return items !== targetID
        })
        question.currentQuestion.push(targetID)
    }else{
        const countQuetion = question.currentQuestion.length
        question.currentQuestion.push(countQuetion)
    }

    targetCount.innerHTML = question.currentQuestion.length
    await callSummernote()
}

async function removeCount(targetID){
    let countQuestion = question.currentQuestion.length
    if(countQuestion > 0){
        
        $(`#Question_${targetID}`).remove();

        currentMultipleChoice = currentMultipleChoice.filter((question) => {
            return question.question !== targetID
        })

        let currentQuestion = question.currentQuestion

        question.currentQuestion = currentQuestion.filter((items) => {
            return items !== targetID
        })

        question.deletedQuestion.push(targetID)
        targetCount.innerHTML = question.currentQuestion.length
    }
    console.log(question)
}

