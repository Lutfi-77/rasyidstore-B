const Ziggy = {"url":"http:\/\/localhost","port":null,"defaults":{},"routes":{"ignition.healthCheck":{"uri":"_ignition\/health-check","methods":["GET","HEAD"]},"ignition.executeSolution":{"uri":"_ignition\/execute-solution","methods":["POST"]},"ignition.updateConfig":{"uri":"_ignition\/update-config","methods":["POST"]},"dashboard":{"uri":"admin\/dashboard","methods":["GET","HEAD"]},"users.index":{"uri":"admin\/users","methods":["GET","HEAD"]},"users.create":{"uri":"admin\/users\/create","methods":["GET","HEAD"]},"users.store":{"uri":"admin\/users","methods":["POST"]},"users.show":{"uri":"admin\/users\/{user}","methods":["GET","HEAD"]},"users.edit":{"uri":"admin\/users\/{user}\/edit","methods":["GET","HEAD"]},"users.update":{"uri":"admin\/users\/{user}","methods":["PUT","PATCH"]},"users.destroy":{"uri":"admin\/users\/{user}","methods":["DELETE"]}}};

if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
    Object.assign(Ziggy.routes, window.Ziggy.routes);
}

export { Ziggy };
