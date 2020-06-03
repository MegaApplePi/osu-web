# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { Observer } from 'mobx-react'
import core from 'osu-core-singleton'
import * as React from 'react'
import { button, div } from 'react-dom-factories'
import { Sort } from 'sort'

el = React.createElement

uiState = core.dataStore.uiState

export class CommentsSort extends React.PureComponent
  render: =>
    el Observer, null, () =>
      el Sort,
        modifiers: @props.modifiers
        onSortSelected: @setSort
        sortMode: uiState.comments.loadingSort ? uiState.comments.currentSort
        values: ['new', 'old', 'top']


  setSort: (e) =>
    $.publish 'comments:sort', sort: e.target.dataset.value
