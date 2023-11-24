class Book {
  constructor(_title, _author, _onPage, _maxPage) {
    this.title = _title;
    this.author = _author;
    this.onPage = _onPage;
    this.maxPage = _maxPage;
  }

  appendBookToList() {
    if (this.calculateProgress() < 100) {
      return `
        <li class="text-danger">
            <i class="fa-solid fa-circle-xmark"></i> You still need to read "${this.title}" by ${this.author}
        </li>`;
    }
    return `
        <li class="text-success">
            <i class="fa-solid fa-circle-check"></i> You already read "${this.title}" by ${this.author}
        </li>`;
  }

  appendBookToTable() {
    let progress = this.calculateProgress().toFixed(1);
    let html = `
    <tr>
        <td class="border counterCell"></td>
        <td class="border">${this.title}</td>
        <td class="border">${this.author}</td>
        <td class="border">${this.onPage}</td>
        <td class="border">${this.maxPage}</td>
        <td class="border">
            <div class="progres-container">
                <div class="progressBar" style="width:${progress}%;">
                    <p class="m-0 text-center">${progress}%</p>
                </div>
            </div>
        </td>
    </tr>`;
    return html;
  }

  calculateProgress() {
    return (this.onPage / this.maxPage) * 100;
  }
}
