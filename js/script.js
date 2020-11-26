function start() {
  function loadTable(e) {
    e.preventDefault()
    const qtdDezenas = document.querySelector('#qtdDezenas').value
    const totalGames = document.querySelector('#totalGames').value
    axios({
      method: 'POST',
      url: 'index.php',
      data: { qtdDezenas, totalGames },
    }).then((resultData) => {
      let resultTable = document.querySelector('#result')
      resultTable.innerHTML = ''

      const table = document.createElement('table')
      table.classList.add('blueTable')
      table.style.border = 1
      const tr = document.createElement('tr')
      const tdResult = document.createElement('td')
      tdResult.innerHTML = 'Resultado'
      tr.append(tdResult)

      resultData.data.result.forEach((i) => {
        const td = document.createElement('td')
        td.innerHTML = i
        tr.append(td)
      })
      table.append(tr)
      resultTable.append(table)
      const br = document.createElement('br')
      resultTable.append(br)
      resultTable.append(br)

      const tableData = document.createElement('table')
      tableData.classList.add('blueTable')

      resultData.data.games.forEach((arr) => {
        const trData = document.createElement('tr')
        const tdInit = document.createElement('td')
        tdInit.innerHTML = 'Jogo '
        trData.append(tdInit)
        arr.numbers.forEach((i) => {
          const td = document.createElement('td')
          td.innerHTML = i
          trData.append(td)
        })
        const td = document.createElement('td')

        td.innerHTML = 'Acertos: ' + arr.hits
        trData.append(td)
        tableData.append(trData)
      })

      resultTable.append(tableData)
    })
  }

  const button = document.querySelector('#btnGenerate')
  button.addEventListener('click', loadTable)
}

start()
