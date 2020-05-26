<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'event' => [
        'approve' => 'Одобрена.',
        'discussion_delete' => 'Модератор удалил отзыв :discussion.',
        'discussion_lock' => 'Обсуждение для этой карты было отключено. (:text)',
        'discussion_post_delete' => 'Модератор удалил публикацию из отзыва :discussion.',
        'discussion_post_restore' => 'Модератор восстановил публикацию в отзыве :discussion.',
        'discussion_restore' => 'Модератор восстановил отзыв :discussion.',
        'discussion_unlock' => 'Обсуждение для этой карты было включено.',
        'disqualify' => 'Дисквалифицирована :user. Причина: :text.',
        'disqualify_legacy' => 'Дисквалифицирована :user. Причина: :text.',
        'genre_edit' => '',
        'issue_reopen' => 'Проблема в :discussion вновь решена.',
        'issue_resolve' => 'Проблема :discussion отмечена как решенная.',
        'kudosu_allow' => 'Кудосу из отзыва :discussion были удалены.',
        'kudosu_deny' => 'Отзыву :discussion отказано в кудосу.',
        'kudosu_gain' => 'Отзыв :discussion от :user получил достаточно голосов для получения кудосу.',
        'kudosu_lost' => 'Отзыв :discussion от :user потерял голоса и присуждённые кудосу были удалены.',
        'kudosu_recalculate' => 'Кудосу за отзыв :discussion были пересчитаны.',
        'language_edit' => '',
        'love' => 'Добавлено :user в любимое',
        'nominate' => 'Номинирована :user.',
        'nomination_reset' => 'Из-за новой проблемы в :discussion статус номинации был сброшен.',
        'qualify' => 'Эта карта была номинирована достаточное количество раз для квалификации.',
        'rank' => 'Рейтинговая.',
    ],

    'index' => [
        'title' => 'События карты',

        'form' => [
            'period' => 'Период',
            'types' => 'Типы',
        ],
    ],

    'item' => [
        'content' => 'Контент',
        'discussion_deleted' => '[удалено]',
        'type' => 'Тип',
    ],

    'type' => [
        'approve' => 'Одобрено',
        'discussion_delete' => 'Удаление обсуждения',
        'discussion_post_delete' => 'Удаление ответов в обсуждении',
        'discussion_post_restore' => 'Восстановление ответов в обсуждении',
        'discussion_restore' => 'Восстановление обсуждения',
        'disqualify' => 'Дисквалификация',
        'genre_edit' => '',
        'issue_reopen' => 'Возобновление обсуждения',
        'issue_resolve' => 'Обсуждение решения',
        'kudosu_allow' => 'Квота Kudosu',
        'kudosu_deny' => 'Отказ в Kudosu',
        'kudosu_gain' => 'Получение Kudosu',
        'kudosu_lost' => 'Потеря Kudosu',
        'kudosu_recalculate' => 'Перерасчет Kudosu',
        'language_edit' => '',
        'love' => 'Любовь',
        'nominate' => 'Номинация',
        'nomination_reset' => 'Сброс номинации',
        'qualify' => 'Квалификация',
        'rank' => 'Рейтинг',
    ],
];
