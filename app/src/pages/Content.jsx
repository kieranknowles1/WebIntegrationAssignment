import PropTypes from 'prop-types'
import React from 'react'

/** @typedef {import('../components/LoadingDisplay').LoadingStatus} LoadingStatus */
import LoadingDisplay, { getHighestStatus } from '../components/LoadingDisplay'
import ContentItem from '../components/ContentItem'

import DataFetcherContext from '../contexts/DataFetcherContext'
/** @typedef {import('../api/getContent').Content} Content */
import { PAGE_SIZE } from '../api/getContent'

/**
 * Content page
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */
function Content (props) {
  const fetcher = React.useContext(DataFetcherContext)

  const [contentStatus, setContentStatus] = React.useState(/** @type {LoadingStatus} */ ('loading'))
  const [content, setContent] = React.useState(/** @type {Content[]} */ ([]))

  const [contentTypesStatus, setContentTypesStatus] = React.useState(/** @type {LoadingStatus} */ ('loading'))
  const [types, setTypes] = React.useState(/** @type {string[]} */ ([]))

  const [totalPagesStatus, setTotalPagesStatus] = React.useState(/** @type {LoadingStatus} */ ('loading'))
  const [totalPages, setTotalPages] = React.useState(/** @type {Map<string | undefined, number>} */ (new Map()))

  React.useEffect(() => {
    setContentStatus('loading')
    setContent([])

    fetcher.content(props.page, props.selectedType).get()
      .then(content => {
        setContent(content)
        setContentStatus('done')
      })
      .catch(err => {
        console.error(err)
        setContentStatus('error')
      })
  }, [props.page, props.selectedType])

  React.useEffect(() => {
    setContentTypesStatus('loading')
    fetcher.contentTypes.get()
      .then(types => {
        setTypes(types)
        setContentTypesStatus('done')
      })
      .catch(err => {
        console.error(err)
        setContentTypesStatus('error')
      })
  }, [])

  React.useEffect(() => {
    setTotalPagesStatus('loading')
    fetcher.contentCount.get()
      .then(result => {
        const map = new Map()
        map.set(undefined, Math.ceil(result.total / PAGE_SIZE))
        for (const type of result.counts) {
          map.set(type.type, Math.ceil(type.count / PAGE_SIZE))
        }
        setTotalPages(map)
        setTotalPagesStatus('done')
      })
      .catch(err => {
        console.error(err)
        setTotalPagesStatus('error')
      })
  }, [])

  /** @param {React.ChangeEvent<HTMLSelectElement>} e */
  function updateSelectedType (e) {
    const value = e.target.value === '' ? undefined : e.target.value
    props.setSelectedType(value)
    props.setPage(1)
  }

  // Float one left and other right
  const pageButtons = (
    <div className='flex items-stretch text-3xl'>
      <button className='grow' onClick={() => props.setPage(props.page - 1)} disabled={props.page <= 1}>Previous</button>
      <p className='grow text-center'>Page {props.page}</p>
      <button className='grow' onClick={() => props.setPage(props.page + 1)} disabled={props.page >= (totalPages.get(props.selectedType) || 1)}>Next</button>
    </div>
  )

  return (
    <main>
      <h1>Content</h1>
      <select onChange={updateSelectedType} className='bg-background-button' value={props.selectedType || ''}>
        {/* NOTE: value={null} is not supported by React, so we use an empty string instead */}
        <option value={''}>All content</option>
        {types.map(type => <option key={type} value={type}>{type}</option>)}
      </select>
      {pageButtons}
      <LoadingDisplay status={getHighestStatus([contentStatus, contentTypesStatus, totalPagesStatus])} />
      <ul className='grid sm:grid-cols-1 lg:grid-cols-2 gap-3'>
        {content.map(item => <ContentItem key={item.id} {...item} handleTokenRejected={props.handleTokenRejected} />)}
      </ul>
      {pageButtons}
    </main>
  )
}
Content.propTypes = {
  handleTokenRejected: PropTypes.func.isRequired,
  page: PropTypes.number.isRequired,
  setPage: PropTypes.func.isRequired,
  selectedType: PropTypes.string,
  setSelectedType: PropTypes.func.isRequired
}

export default Content
