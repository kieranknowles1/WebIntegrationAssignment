import React from 'react'

/** @typedef {import('../components/LoadingDisplay').LoadingStatus} LoadingStatus */
import LoadingDisplay, { getHighestStatus } from '../components/LoadingDisplay'
import ContentItem from '../components/ContentItem'

/** @typedef {import('../api/getContent').Content} Content */
import getContent from '../api/getContent'
import getContentTypes from '../api/getContentTypes'

/**
 * Content page
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */
function Content () {
  const [contentStatus, setContentStatus] = React.useState(/** @type {LoadingStatus} */ ('loading'))
  const [content, setContent] = React.useState(/** @type {ContentItem[]} */ ([]))

  const [contentTypesStatus, setContentTypesStatus] = React.useState(/** @type {LoadingStatus} */ ('loading'))
  const [types, setTypes] = React.useState(/** @type {string[]} */ ([]))

  // TODO: Keep previous pages in memory
  const [page, setPage] = React.useState(1)
  const [selectedType, setSelectedType] = React.useState(/** @type {string | undefined} */ (undefined))

  React.useEffect(() => {
    setContentStatus('loading')
    setContent([])
    console.log(selectedType)
    getContent(page, selectedType)
      .then(content => {
        setContent(content.map((item, index) => <ContentItem key={index} {...item} />))
        setContentStatus('done')
      })
      .catch(err => {
        console.error(err)
        setContentStatus('error')
      })
  }, [page, selectedType])

  React.useEffect(() => {
    setContentTypesStatus('loading')
    getContentTypes()
      .then(types => {
        setTypes(types)
        setContentTypesStatus('done')
      })
      .catch(err => {
        console.error(err)
        setContentTypesStatus('error')
      })
  }, [])

  /** @param {React.ChangeEvent<HTMLSelectElement>} e */
  function updateSelectedType (e) {
    const value = e.target.value === '' ? null : e.target.value
    setSelectedType(value)
    setPage(1)
  }

  // Float one left and other right
  const pageButtons = (
    <div className='flex items-stretch text-3xl'>
      <button className='grow' onClick={() => setPage(page - 1)} disabled={page <= 1}>Previous</button>
      <p className='grow text-center'>Page {page}</p>
      <button className='grow' onClick={() => setPage(page + 1)}>Next</button>
    </div>
  )

  return (
    <main>
      <h1>Content</h1>
      <select onChange={updateSelectedType} className='bg-background-button' defaultValue='' >
        {/* NOTE: value={null} is not supported by React, so we use an empty string instead */}
        <option value={''}>All content</option>
        {types.map(type => <option key={type} value={type}>{type}</option>)}
      </select>
      {pageButtons}
      <LoadingDisplay status={getHighestStatus([contentStatus, contentTypesStatus])} />
      <ul className='grid sm:grid-cols-1 lg:grid-cols-2 gap-3'>
        {content}
      </ul>
      {pageButtons}
    </main>
  )
}

export default Content
