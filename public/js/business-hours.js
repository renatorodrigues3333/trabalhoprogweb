/*
 * Horário de funcionamento da arena.
 *
 * Mostra/esconde os campos de horário conforme o dia é marcado e desabilita
 * os inputs dos dias fechados (assim eles não são enviados no POST).
 *
 * Funciona por data-attributes, sem depender de IDs:
 *   [data-business-hours] ....... container geral
 *   [data-bh-day] ............... linha de um dia
 *   [data-bh-toggle] ............ checkbox "abre neste dia"
 *   [data-bh-times] ............. bloco com os inputs de horário
 *
 * Para mudar o comportamento, edite APENAS este arquivo.
 */
(function () {
    'use strict';

    function syncDay(row) {
        var toggle = row.querySelector('[data-bh-toggle]');
        var times = row.querySelector('[data-bh-times]');
        if (!toggle || !times) {
            return;
        }

        var open = toggle.checked;
        row.classList.toggle('is-open', open);

        // Inputs de dias fechados ficam desabilitados -> não vão no formulário.
        times.querySelectorAll('input').forEach(function (input) {
            input.disabled = !open;
        });
    }

    function init(container) {
        container.querySelectorAll('[data-bh-day]').forEach(function (row) {
            var toggle = row.querySelector('[data-bh-toggle]');
            if (!toggle) {
                return;
            }

            syncDay(row);                       // estado inicial (respeita old() do Blade)
            toggle.addEventListener('change', function () {
                syncDay(row);
            });
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('[data-business-hours]').forEach(init);
    });
})();
