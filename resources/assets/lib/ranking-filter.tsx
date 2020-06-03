// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as React from 'react';
import { Option, OptionRenderProps, SelectOptions } from 'select-options';
import { Sort } from 'sort';

type RankingTypes = 'performance' | 'charts' | 'scores' | 'country';

interface Props {
  countries?: Required<Country>[];
  type: RankingTypes;
}

const allCountries = { id: null, text: osu.trans('rankings.countries.all') };

export default class RankingFilter extends React.PureComponent<Props> {
  private countriesSorted?: Required<Country>[];
  private optionsCached?: Map<string | null, Option<string>>;
  private prevCountries?: Required<Country>[];

  get countries() {
    if (this.props.countries == null) return [];

    if (this.countriesSorted == null) {
      this.countriesSorted = this.props.countries.sort((a, b) => {
        // prioritizes current user's country
        if (currentUser?.country_code === a.code) return -1;
        if (currentUser?.country_code === b.code) return 1;

        const priority = b.display - a.display;

        if (priority !== 0) return priority;

        return a.name.localeCompare(b.name);
      });
    }

    return this.countriesSorted;
  }

  get countryCode() {
    return new URL(window.location.href).searchParams.get('country');
  }

  get filterMode() {
    return new URL(window.location.href).searchParams.get('filter');
  }

  get options() {
    if (this.optionsCached == null) {
      // local assignment workaround for https://github.com/microsoft/TypeScript/issues/36436
      const optionsCached = this.optionsCached = new Map<string | null, Option<string>>();

      optionsCached.set(allCountries.id, allCountries);
      this.countries.forEach((country) => {
        optionsCached.set(country.code, { id: country.code, text: country.name });
      });
    }

    return this.optionsCached;
  }

  get selectedOption() {
    return this.options.get(this.countryCode) ?? allCountries;
  }

  // TODO: rename component prop to onChange
  handleCountryChange = (option: Option) => {
    osu.navigate(osu.updateQueryString(null, { country: option.id, page: null }));
  }

  // TODO: rename component prop to onChange
  handleFilterChange = (event: React.MouseEvent<HTMLButtonElement>) => {
    osu.navigate(osu.updateQueryString(null, { filter: event.currentTarget.dataset.value, page: null }));
  }

  render() {
    // TODO: consider using memoize-one?
    if (this.prevCountries !== this.props.countries) {
      this.countriesSorted = undefined;
      this.optionsCached = undefined;
      this.prevCountries = this.props.countries;
    }

    return (
      <div className='ranking-filter'>
        <div className='ranking-filter__countries'>
          {this.renderCountries()}
        </div>

        {currentUser.id != null && (
          <div className='ranking-filter__sort'>
            <Sort
              onSortSelected={this.handleFilterChange}
              sortMode={this.filterMode ?? 'all'}
              title={osu.trans('rankings.filter.title')}
              values={['all', 'friends']}
            />
          </div>
        )}
      </div>
    );
  }

  renderCountries() {
    if (this.props.type !== 'performance') return null;

    return (
      <SelectOptions
        bn='ranking-select-options'
        renderItem={this.renderOption}
        onItemSelected={this.handleCountryChange}
        options={[...this.options.values()]} // TODO: change to iterable
        selected={this.selectedOption}
      />
    );
  }

  renderOption(option: OptionRenderProps) {
    return (
      <a
        children={option.children}
        className={option.cssClasses}
        href={osu.updateQueryString(null, { country: option.item.id, page: null })}
        key={option.item.id ?? ''}
        onClick={option.onClick}
      />
    );
  }
}
