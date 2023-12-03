import React from 'react'

import ContentItem from '../components/ContentItem'
import LoadingDisplay from '../components/LoadingDisplay'

/** @typedef {import('../api/getContent').Content} Content */
import getContent from '../api/getContent'

/**
 * Content page
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */
function Content () {
  const [status, setStatus] = React.useState('loading')
  /** @type {[Content, function (Content): void]} */
  const [content, setContent] = React.useState(null)

  // TODO: Keep previous pages in memory
  const [page, setPage] = React.useState(1)

  React.useEffect(() => {
    setStatus('loading')
    setContent(null)
    getContent(page)
      .then(content => {
        setContent(content.map((item, index) => <ContentItem key={index} {...item} />))
        setStatus('done')
      })
      .catch(err => {
        console.error(err)
        setStatus('error')
      })
  }, [page])

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
      {pageButtons}
      <LoadingDisplay status={status} />
      <ul className='grid sm:grid-cols-1 lg:grid-cols-2 gap-3'>
        {content}
      </ul>
      {pageButtons}
    </main>
  )
}

export default Content
