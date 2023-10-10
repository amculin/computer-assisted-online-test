<?php
use yii\bootstrap\ActiveForm;

if (! $hasAlert) {
?>
    <div class="row">
        <div class="col-12 col-md-4 mb-4">
            <div class="navnumber-aq-box">
                <div class="navnumber-aq">
                    <div class="navnumber-aq-timer">
                        <div class="aq-timer"><h4>Sisa Waktu :</h4><h5 id="countdown-timer"></h5></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-8 mb-4">
            <div class="question-aq-box text-center" style="font-family: monospace">
                <h3 id="question-description"><?= $model->description; ?></h3>
                <h3>A B C D E</h3>
            </div>
            <div class="answer-aq text-center">
                <div class="answer-go-title">
                    <h4 id="question-detail"><?= $model->question; ?></h4>
                </div>

                <div id="answer-list" class="form-group form-group-mjk">
                    <?php
                    $answerList = ['A', 'B', 'C', 'D', 'E'];
                    $i = 0;

                    foreach($model->questionAnswers as $key => $val) {
                    ?>
                        <div class="custom-control custom-radio radio-mjk mb-2 auto-submit">
                            <input type="radio" id="ASQ<?= $answerList[$i]; ?>" name="answer" value="<?= $val->id; ?>" class="custom-control-input" />
                            <label class="custom-control-label" id="for-ASQ<?= $answerList[$i]; ?>" for="ASQ<?= $answerList[$i]; ?>"><?= $val->answer; ?></label>
                        </div>
                    <?php
                        $i++;
                    }
                    ?>
                    <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
                </div>
            </div>
            <?php $form = ActiveForm::begin([
                'action' => '/student/personality-test/final-submit',
            ]); ?>
            <div class="answer-aq-action">
                <div class="action-global-box">
                    <input type="hidden" name="active_session" value="<?= md5(Yii::$app->user->identity->username . ' - test'); ?>" />
                    <a class="btn btn-mjk invisible" id="next-question" href="#" title="" >LANJUT</a>
                    <button type="submit" id="final-submission" class="btn btn-mjk invisible" title="">SELESAI</button>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

    <?php
    $nextUrl = Yii::$app->urlManager->createAbsoluteUrl('/student/accuracy-test/get-next');

    $js = "
    $('#finish-question').hide();
    $.ajaxSetup({
        data: " . json_encode([
            \yii::$app->request->csrfParam => \yii::$app->request->csrfToken,
        ]) . "
    });
    function splitString(string) {
        var length = string.length;
        var splittedString = '';

        for (var i = 0; i < length; i++) {
            if (i == (length - 1))
                splittedString += string[i];
            else
                splittedString += string[i] + ' ';
        }
        return splittedString;
    }

    $('#question-description').html(splitString($('#question-description').text()));
    $('#question-detail').html(splitString($('#question-detail').text()));

    var limiter = {$timeLimit};
    var isModalShowed = false;

    function runTimer() {
        var limitTime = limiter;

        if (limitTime == 0) {
            if (! isModalShowed) {
                $('#next-question').hide();
                $('div.modal-body').html('Waktu mengerjakan sudah habis!');
                $('#exampleModal').attr('data-status', 'ready');
                $('#modal-trigger').click();

                isModalShowed = true;
            }

            return;
        } else {

            var hour = Math.floor(limitTime / 3600).toString();
            var minute = Math.floor((limitTime % 3600) / 60).toString();
            var second = ((limitTime % 3600) % 60).toString();

            $('#countdown-timer').text(hour.padStart(2, '0') + ':' + minute.padStart(2, '0') + ':' + second.padStart(2, '0'));
            limiter--;
        }
    }

    setInterval('runTimer()', 1000);

    $('input[name=answer').change(function() {
        $('#next-question').click();
    })

    //var init = 1;
    $('#next-question').click(function() {
        //console.log($('input[name=jawaban]:checked').val());
        var value = $('input[name=answer]:checked').val();
        var csrf = $('input[name=_csrf]').val();

        if ($('input[name=answer]').is(':checked')) {
            console.log(value);
            $.ajax({
                url: '{$nextUrl}',
                type: 'POST',
                data: 'answer=' + value + '&_csrf=' + csrf,
                dataType: 'json',
                headers: {'X-CSRF-Token':csrf},
                success:function(data){
                    if (data.isCompleted) {
                        $('#next-question').hide();
                        $('div.modal-body').html('Soal sudah habis!');
                        $('#exampleModal').attr('data-status', 'ready');
                        $('#modal-trigger').click();
                    } else {
                        $('input[name=answer]:checked').prop('checked', false);
                        $('div.question-aq-box h3#question-description').html(splitString(data.description));
                        $('h4#question-detail').html(splitString(data.question));
                        console.log(data);

                        var answerList = ['A', 'B', 'C', 'D', 'E'];
                        var i = 0;

                        data.answer_list.forEach(function(value, index) {
                            $('input#ASQ' + answerList[i]).attr('value', value);
                            //$('label#for-ASQ' + answerList[i]).html(value.label);

                            i++;
                        });
                    }
                }
            });
        } else {
            $('div.modal-body').html('Anda belum memilih jawaban!');
            $('#modal-trigger').click();
        }
    });

    $('#exampleModal').on('shown.bs.modal', function (e) {
        if ($('#exampleModal').attr('data-status') == 'ready') {
            setInterval(function() {
                $('#w0').submit();
            }, 3000);
        }
    });
    ";

    $this->registerJs($js, \yii\web\View::POS_END);
} else {
    $js = "$('#modal-trigger').click()";
    $this->registerJs($js, \yii\web\View::POS_END);
}
?>

<!-- Button trigger modal -->
<button type="button" id="modal-trigger" class="btn btn-primary invisible" data-toggle="modal" data-target="#exampleModal">
    Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Peringatan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <?= $alert; ?>
        </div>
        <div class="modal-footer" style="padding: 20px 15px 20px !important">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        </div>
        </div>
    </div>
</div>