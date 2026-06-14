/*
 * Quadras da arena.
 *
 * Permite adicionar/remover quadras no formulário, mantendo sempre pelo menos
 * uma (a arena precisa de no mínimo uma quadra). Cada quadra adicionada é uma
 * cópia do <template data-court-template>, com índice único nos name="".
 *
 * Funciona por data-attributes, sem IDs:
 *   [data-courts] .............. container geral
 *   [data-courts-list] ......... onde os cards de quadra ficam
 *   [data-court-template] ...... modelo (<template>) clonado ao adicionar
 *   [data-add-court] ........... botão "+ Adicionar quadra"
 *   [data-court-row] ........... card de uma quadra
 *   [data-remove-court] ........ botão de remover do card
 *   [data-court-num] ........... rótulo "Quadra N" (renumerado automaticamente)
 *
 * Para mudar o comportamento, edite APENAS este arquivo.
 */
(function () {
    'use strict';

    function renumber(list) {
        var rows = list.querySelectorAll('[data-court-row]');
        rows.forEach(function (row, i) {
            var num = row.querySelector('[data-court-num]');
            if (num) {
                num.textContent = 'Quadra ' + (i + 1);
            }
            // Esconde o "remover" quando só resta uma quadra.
            var remove = row.querySelector('[data-remove-court]');
            if (remove) {
                remove.style.display = rows.length > 1 ? '' : 'none';
            }
        });
    }

    function init(container) {
        var list = container.querySelector('[data-courts-list]');
        var template = container.querySelector('[data-court-template]');
        var addBtn = container.querySelector('[data-add-court]');
        if (!list || !template || !addBtn) {
            return;
        }

        // Índice único e crescente para os name="quadras[...]".
        var counter = list.querySelectorAll('[data-court-row]').length;

        addBtn.addEventListener('click', function () {
            var html = template.innerHTML.replace(/__INDEX__/g, 'new_' + counter);
            counter++;

            var temp = document.createElement('div');
            temp.innerHTML = html.trim();
            var row = temp.firstElementChild;
            if (row) {
                list.appendChild(row);
                renumber(list);
            }
        });

        list.addEventListener('click', function (e) {
            var btn = e.target.closest('[data-remove-court]');
            if (!btn) {
                return;
            }
            var rows = list.querySelectorAll('[data-court-row]');
            if (rows.length <= 1) {
                return; // mantém sempre pelo menos uma quadra
            }
            btn.closest('[data-court-row]').remove();
            renumber(list);
        });

        // "Multiesporte (todos)" <-> esportes individuais (delegação cobre quadras novas).
        list.addEventListener('change', function (e) {
            var row = e.target.closest('[data-court-row]');
            if (!row) {
                return;
            }
            var all = row.querySelector('[data-court-all-sports]');
            var sports = row.querySelectorAll('input[type="checkbox"][name*="[esportes]"]');

            // Marcou/desmarcou "todos": replica para cada esporte.
            if (e.target === all) {
                sports.forEach(function (cb) {
                    cb.checked = all.checked;
                });
                return;
            }

            // Mexeu num esporte: "todos" fica marcado só se todos estiverem.
            if (e.target.matches('input[name*="[esportes]"]') && all) {
                all.checked = Array.prototype.every.call(sports, function (cb) {
                    return cb.checked;
                });
            }
        });

        renumber(list);
    }

    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('[data-courts]').forEach(init);
    });
})();
