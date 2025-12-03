function Computer(processore, disco, ram){
    this.processore = processore;
    this.disco = disco;
    this.ram = ram;
}

Computer.prototype.infoComputerConsole = function(){
    console.log("Processore:" + this.processore + "; +Disco: " + this.disco + "; RAM: "+ this.ram);
};

Computer.prototype.infoComputerDOM = function(id){
    document.getElementById(id).innerHTML = `
    <p>Processore: ${this.processore}</p>
    <p>Disco: ${this.disco}</p>
    <p>RAM: ${this.ram}</p>
    `;
};

const mioPc = new Computer("i7", "5TB", "64GB");
mioPc.infoComputerConsole();
mioPc.infoComputerDOM("miopc");