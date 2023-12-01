/**
 * Converts a YouTube video link to an embed link
 * @param {string} viewLink The YouTube video link
 * @example
 * const embedLink = getEmbedLink('https://www.youtube.com/watch?v=dQw4w9WgXcQ')
 * <iframe src={embedLink} />
 * @return {string} The embed link for use in an iframe
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */
export default function getEmbedLink (viewLink) {
  const url = new URL(viewLink)
  const videoId = url.searchParams.get('v')
  return `https://www.youtube.com/embed/${videoId}`
}
